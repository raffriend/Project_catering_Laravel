<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil semua pesanan milik user
        $orders = Order::with(['items.menu', 'items.cateringPackage', 'payments', 'promotion'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        // Statistik pesanan pelanggan
        $totalOrders = Order::where('user_id', $user->id)->count();
        $processingOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['masuk', 'dikonfirmasi', 'diproses', 'dikirim'])
            ->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->count();
        $unpaidOrders = Order::where('user_id', $user->id)
            ->whereIn('payment_status', ['belum_bayar', 'dp'])
            ->count();

        // Ambil testimoni milik user
        $myTestimonials = Testimonial::where('user_id', $user->id)->latest()->get();

        return view('customer.dashboard', compact(
            'user',
            'orders',
            'totalOrders',
            'processingOrders',
            'completedOrders',
            'unpaidOrders',
            'myTestimonials'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'address' => 'required|string|max:500',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'phone.required' => 'Nomor HP/WhatsApp wajib diisi.',
            'address.required' => 'Alamat pengiriman wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $userData = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        // Sinkronisasi dengan tabel customers jika ada
        Customer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'address' => $user->address,
            ]
        );

        return back()->with('success', 'Data profil Anda berhasil diperbarui!');
    }

    public function storeTestimonial(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'customer_title' => 'nullable|string|max:100',
            'comment' => 'required|string|min:10|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'rating.required' => 'Silakan pilih bintang rating (1 - 5).',
            'comment.required' => 'Ulasan / testimoni wajib diisi.',
            'comment.min' => 'Ulasan minimal 10 karakter.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $fileName = 'TESTI_' . time() . '_' . Str::random(5) . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('uploads/testimonials'), $fileName);
            $photoPath = 'uploads/testimonials/' . $fileName;
        }

        Testimonial::create([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'customer_title' => $validated['customer_title'] ?: 'Pelanggan CV. Kedai Agung',
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'photo' => $photoPath,
            'is_active' => true,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan & testimoni Anda! Ulasan Anda kini tampil di halaman utama kami.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        if ($testimonial->user_id !== Auth::id()) {
            abort(403);
        }

        $testimonial->delete();

        return back()->with('success', 'Testimoni Anda berhasil dihapus.');
    }

    /**
     * Pelunasan / Pembayaran sisa tagihan pesanan katering oleh pelanggan
     */
    public function payOrder(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses pesanan tidak diizinkan.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:transfer,qris,cash',
            'payment_type' => 'required|in:pelunasan,dp,full',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'notes' => 'nullable|string|max:500',
        ], [
            'amount.required' => 'Nominal pembayaran wajib diisi.',
            'proof_image.required' => 'Unggah foto struk / bukti transfer pembayaran.',
            'proof_image.image' => 'File harus berupa gambar.',
        ]);

        $imagePath = null;
        if ($request->hasFile('proof_image')) {
            $fileName = 'PAY_' . time() . '_' . Str::random(6) . '.' . $request->file('proof_image')->getClientOriginalExtension();
            $request->file('proof_image')->move(public_path('uploads/payments'), $fileName);
            $imagePath = 'uploads/payments/' . $fileName;
        }

        $paymentNumber = 'PAY-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        Payment::create([
            'order_id' => $order->id,
            'payment_number' => $paymentNumber,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_type' => $validated['payment_type'],
            'proof_image' => $imagePath,
            'status' => 'menunggu_konfirmasi',
            'payment_date' => Carbon::now(),
            'notes' => $validated['notes'],
        ]);

        return back()->with('success', "Bukti {$validated['payment_type']} untuk pesanan {$order->order_number} berhasil dikirim! Menunggu konfirmasi manager/kasir.");
    }
}

