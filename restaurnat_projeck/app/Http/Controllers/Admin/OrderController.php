<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CateringPackage;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items', 'customer', 'payments'])->latest();

        if ($request->filled('order_type')) {
            if ($request->order_type === 'ampera') {
                $query->where('order_type', 'ampera');
            } elseif ($request->order_type === 'catering') {
                $query->where('order_type', 'like', 'catering%');
            }
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('delivery_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('delivery_date', '<=', $request->date_to);
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.menu', 'items.cateringPackage', 'customer', 'payments.verifier', 'promotion']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load(['items.menu', 'items.cateringPackage']);
        $packages = CateringPackage::where('is_active', true)->get();
        $menus = Menu::where('is_available', true)->get();

        return view('admin.orders.edit', compact('order', 'packages', 'menus'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:25',
            'delivery_address' => 'nullable|string|max:500',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable',
            'status' => 'required|in:masuk,dikonfirmasi,diproses,dikirim,selesai,dibatalkan',
            'payment_status' => 'required|in:belum_bayar,dp,lunas',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
        ], [
            'customer_name.required' => 'Nama pemesan wajib diisi.',
            'items.required' => 'Pesanan harus memiliki minimal satu item.',
        ]);

        return DB::transaction(function () use ($request, $validated, $order) {
            $subtotal = 0;
            $totalQuantity = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $qty = (int)$item['quantity'];
                $price = (float)$item['unit_price'];
                $lineSubtotal = $qty * $price;
                $subtotal += $lineSubtotal;
                $totalQuantity += $qty;

                $itemsData[] = [
                    'order_id' => $order->id,
                    'catering_package_id' => $item['catering_package_id'] ?? null,
                    'menu_id' => $item['menu_id'] ?? null,
                    'item_name' => $item['item_name'],
                    'unit_price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $lineSubtotal,
                    'notes' => $item['notes'] ?? null,
                ];
            }

            // Hitung ulang promo & bonus bolu jika pesanan katering
            $bonusInfo = $order->bonus_info;
            $discountAmount = 0;
            $promotionId = $order->promotion_id;

            if ($order->isCatering()) {
                if ($totalQuantity >= 50) {
                    $bonusInfo = 'Gratis 1 Loyang Bolu Panggang Lembut (Promo 50 Box)';
                } else {
                    $bonusInfo = null;
                }
            }

            $finalAmount = max(0, $subtotal - $discountAmount);

            // Update data pesanan
            $order->update([
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_address' => $validated['delivery_address'],
                'delivery_date' => $validated['delivery_date'],
                'delivery_time' => $validated['delivery_time'],
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'total_amount' => $finalAmount,
                'status' => $validated['status'],
                'payment_status' => $validated['payment_status'],
                'notes' => $validated['notes'],
                'bonus_info' => $bonusInfo,
            ]);

            // Sinkronisasi item pesanan (hapus lama, masukkan yang baru)
            $order->items()->delete();
            foreach ($itemsData as $row) {
                OrderItem::create($row);
            }

            return redirect()->route('admin.orders.show', $order->id)
                ->with('success', "Pesanan {$order->order_number} berhasil diperbarui oleh kasir/manager.");
        });
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:masuk,dikonfirmasi,diproses,dikirim,selesai,dibatalkan',
            'payment_status' => 'required|in:belum_bayar,dp,lunas',
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pesanan ' . $order->order_number . ' berhasil diperbarui.');
    }

    public function invoice(Order $order)
    {
        $order->load(['items', 'customer', 'payments', 'promotion']);
        return view('admin.orders.invoice', compact('order'));
    }
}
