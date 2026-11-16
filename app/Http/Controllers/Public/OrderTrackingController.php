<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderTrackingController extends Controller
{
    public function index(Request $request)
    {
        // Pengunjung tanpa akun diarahkan ke login
        if (!Auth::check()) {
            return redirect()->guest(route('login'))
                ->with('info', 'Silakan masuk ke akun Anda untuk melacak dan melihat status pesanan Anda.');
        }

        $order = null;
        if ($request->filled('order_number')) {
            $order = Order::with(['items', 'promotion', 'payments'])
                ->where('order_number', trim($request->order_number))
                ->first();
        }

        // Jika user adalah customer dan tidak memasukkan order_number, default ambil pesanan terakhirnya
        if (!$order && Auth::user()->isCustomer()) {
            $order = Order::with(['items', 'promotion', 'payments'])
                ->where('user_id', Auth::id())
                ->latest()
                ->first();
        }

        return view('public.order-tracking', compact('order'));
    }

    public function uploadPayment(Request $request, $orderNumber)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengunggah bukti pembayaran.');
        }

        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        // Validasi kepemilikan pesanan jika bukan manager
        if (!Auth::user()->isManager() && $order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses pada pesanan ini.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:transfer,qris,cash',
            'payment_type' => 'required|in:full,dp,pelunasan',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'notes' => 'nullable|string|max:500',
        ], [
            'amount.required' => 'Nominal pembayaran wajib diisi.',
            'amount.numeric' => 'Nominal harus berupa angka.',
            'proof_image.required' => 'Unggah foto struk / bukti transfer Anda.',
            'proof_image.image' => 'File harus berupa gambar.',
            'proof_image.max' => 'Ukuran file bukti maksimal 3MB.',
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

        // Update payment_status jika DP atau Pelunasan
        if ($validated['payment_type'] === 'dp' && $order->payment_status === 'belum_bayar') {
            $order->update(['payment_status' => 'dp']);
        }

        return redirect()->back()
            ->with('success', 'Bukti pembayaran berhasil diunggah! Manager/Kasir akan segera memverifikasi pembayaran Anda.');
    }
}
