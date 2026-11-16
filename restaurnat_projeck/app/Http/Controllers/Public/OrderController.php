<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CateringPackage;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function showForm(Request $request)
    {
        // Pengunjung tanpa akun diarahkan ke login/register terlebih dahulu
        if (!Auth::check()) {
            return redirect()->guest(route('login'))
                ->with('info', 'Silakan masuk ke akun Anda atau daftar terlebih dahulu untuk melakukan pemesanan katering.');
        }

        $packages = CateringPackage::where('is_active', true)->get();
        $menus = Menu::where('is_available', true)->get();
        $selectedPackageId = $request->query('package_id');

        $activePromos = Promotion::where('is_active', true)
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->get();

        $currentUser = Auth::user();

        return view('public.order-form', compact('packages', 'menus', 'selectedPackageId', 'activePromos', 'currentUser'));
    }

    public function submitOrder(Request $request)
    {
        // Pastikan harus terautentikasi
        if (!Auth::check()) {
            return redirect()->guest(route('login'))
                ->with('info', 'Silakan masuk ke akun Anda atau daftar terlebih dahulu untuk melakukan pemesanan katering.');
        }

        $validated = $request->validate([
            'order_type' => 'required|in:catering_paket,catering_custom',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:25',
            'customer_email' => 'nullable|email|max:255',
            'delivery_address' => 'required|string|max:500',
            'delivery_date' => 'required|date|after_or_equal:today',
            'delivery_time' => 'required',
            'notes' => 'nullable|string|max:1000',

            // Paket Katering
            'package_id' => 'required_if:order_type,catering_paket|nullable|exists:catering_packages,id',
            'package_quantity' => 'required_if:order_type,catering_paket|nullable|integer|min:1',

            // Custom Menu
            'menu_ids' => 'required_if:order_type,catering_custom|nullable|array',
            'menu_ids.*' => 'exists:menus,id',
            'menu_quantities' => 'required_if:order_type,catering_custom|nullable|array',
            'menu_quantities.*' => 'integer|min:1',
        ], [
            'customer_name.required' => 'Nama pemesan wajib diisi.',
            'customer_phone.required' => 'Nomor HP/WhatsApp wajib diisi.',
            'delivery_address.required' => 'Alamat pengiriman wajib diisi.',
            'delivery_date.required' => 'Tanggal pengiriman wajib diisi.',
            'delivery_date.after_or_equal' => 'Tanggal pengiriman minimal hari ini.',
            'delivery_time.required' => 'Jam pengiriman wajib ditentukan.',
            'package_id.required_if' => 'Silakan pilih salah satu paket katering.',
            'package_quantity.required_if' => 'Tentukan jumlah porsi katering.',
        ]);

        return DB::transaction(function () use ($request, $validated) {
            $user = Auth::user();

            // Find or create Customer
            $customer = Customer::firstOrCreate(
                ['phone' => $validated['customer_phone']],
                [
                    'user_id' => $user->id,
                    'name' => $validated['customer_name'],
                    'email' => $validated['customer_email'] ?? $user->email,
                    'address' => $validated['delivery_address'],
                    'customer_type' => 'individual',
                ]
            );

            // Jika customer belum punya user_id, hubungkan ke user saat ini
            if (!$customer->user_id) {
                $customer->update(['user_id' => $user->id]);
            }

            // Generate unique Order Number: ORD-YYYYMMDD-XXXX
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            $subtotal = 0;
            $totalQuantity = 0;
            $itemsData = [];

            if ($validated['order_type'] === 'catering_paket') {
                $package = CateringPackage::findOrFail($validated['package_id']);
                $qty = (int)$validated['package_quantity'];

                // Validate minimum order
                if ($qty < $package->min_order) {
                    return back()->withInput()->with('error', "Minimal pemesanan untuk {$package->name} adalah {$package->min_order} porsi.");
                }

                $itemSubtotal = $package->price_per_package * $qty;
                $subtotal += $itemSubtotal;
                $totalQuantity += $qty;

                $itemsData[] = [
                    'catering_package_id' => $package->id,
                    'menu_id' => null,
                    'item_name' => $package->name,
                    'unit_price' => $package->price_per_package,
                    'quantity' => $qty,
                    'subtotal' => $itemSubtotal,
                    'notes' => 'Paket Katering Lengkap',
                ];
            } else {
                // Custom menu selection
                foreach ($request->menu_ids ?? [] as $menuId) {
                    $qty = (int)($request->menu_quantities[$menuId] ?? 0);
                    if ($qty > 0) {
                        $menu = Menu::findOrFail($menuId);
                        $itemSubtotal = $menu->price * $qty;
                        $subtotal += $itemSubtotal;
                        $totalQuantity += $qty;

                        $itemsData[] = [
                            'catering_package_id' => null,
                            'menu_id' => $menu->id,
                            'item_name' => $menu->name,
                            'unit_price' => $menu->price,
                            'quantity' => $qty,
                            'subtotal' => $itemSubtotal,
                            'notes' => null,
                        ];
                    }
                }
            }

            if ($subtotal <= 0) {
                return back()->withInput()->with('error', 'Jumlah pesanan tidak boleh kosong.');
            }

            // Hitung Otomatis Promo & Bonus:
            // "Pesan 50 box mendapatkan bonus 1 loyang bolu"
            $matchedPromotion = null;
            $discountAmount = 0;
            $bonusInfo = null;

            $activePromos = Promotion::where('is_active', true)
                ->whereDate('start_date', '<=', Carbon::today())
                ->whereDate('end_date', '>=', Carbon::today())
                ->get();

            foreach ($activePromos as $promo) {
                $isQtyQualified = ($promo->min_order_qty > 0 && $totalQuantity >= $promo->min_order_qty);
                $isAmountQualified = ($promo->min_order_amount > 0 && $subtotal >= $promo->min_order_amount);

                if ($isQtyQualified || $isAmountQualified) {
                    $matchedPromotion = $promo;

                    if ($promo->bonus_description) {
                        $bonusInfo = $promo->bonus_description;
                    }

                    if ($promo->discount_percent > 0) {
                        $discountAmount = ($subtotal * $promo->discount_percent) / 100;
                    } elseif ($promo->discount_amount > 0) {
                        $discountAmount = $promo->discount_amount;
                    }
                    break;
                }
            }

            // Default fallback bonus if >= 50 portion
            if (!$bonusInfo && $totalQuantity >= 50) {
                $bonusInfo = 'Gratis 1 Loyang Bolu Panggang Lembut (Promo 50 Box)';
            }

            $finalAmount = max(0, $subtotal - $discountAmount);

            // Create Order
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_id' => $customer->id,
                'user_id' => $user->id,
                'order_type' => $validated['order_type'],
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_address' => $validated['delivery_address'],
                'delivery_date' => $validated['delivery_date'],
                'delivery_time' => $validated['delivery_time'],
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'total_amount' => $finalAmount,
                'status' => 'masuk',
                'payment_status' => 'belum_bayar',
                'notes' => $validated['notes'],
                'promotion_id' => $matchedPromotion?->id,
                'bonus_info' => $bonusInfo,
            ]);

            // Create Order Items
            foreach ($itemsData as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }

            return redirect()->route('customer.dashboard')
                ->with('success', "Pesanan katering Anda ({$order->order_number}) berhasil dibuat! Pesanan telah masuk ke sistem kami dan sedang menunggu konfirmasi manager.");
        });
    }

    public function summary($orderNumber)
    {
        $order = Order::with(['items', 'promotion', 'payments'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('public.order-summary', compact('order'));
    }
}
