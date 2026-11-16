<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AmperaController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->with(['menus' => function($q) {
            $q->where('is_available', true);
        }])->get();

        $menusQuery = Menu::with('category')->where('is_available', true);

        if ($request->filled('category_id')) {
            $menusQuery->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $menusQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $menusQuery->orderBy('name')->get();

        // Transaksi Ampera hari ini
        $todayTransactions = Order::with('items')
            ->where('order_type', 'ampera')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->take(10)
            ->get();

        $todayTotalSales = Order::where('order_type', 'ampera')
            ->whereDate('created_at', Carbon::today())
            ->where('payment_status', 'lunas')
            ->sum('total_amount');

        $todayCount = $todayTransactions->count();

        return view('admin.ampera.index', compact('categories', 'menus', 'todayTransactions', 'todayTotalSales', 'todayCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:100',
            'service_type' => 'required|in:dine_in,take_away',
            'payment_method' => 'required|in:cash,qris,transfer',
            'cash_received' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ], [
            'items.required' => 'Pilih minimal satu menu untuk transaksi.',
            'items.min' => 'Pilih minimal satu menu untuk transaksi.',
        ]);

        return DB::transaction(function () use ($request, $validated) {
            $orderNumber = 'AMP-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            $customerName = !empty($validated['customer_name']) ? $validated['customer_name'] : ($validated['service_type'] === 'dine_in' ? 'Pelanggan Dine-in Ampera' : 'Pelanggan Bungkus Ampera');
            $serviceLabel = $validated['service_type'] === 'dine_in' ? 'Makan di Tempat (Ampera)' : 'Bungkus / Take Away (Ampera)';

            $subtotal = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $qty = (int)$item['quantity'];
                $lineTotal = $menu->price * $qty;
                $subtotal += $lineTotal;

                $itemsData[] = [
                    'menu_id' => $menu->id,
                    'item_name' => $menu->name,
                    'unit_price' => $menu->price,
                    'quantity' => $qty,
                    'subtotal' => $lineTotal,
                    'notes' => null,
                ];
            }

            $totalAmount = $subtotal;
            $cashReceived = $validated['cash_received'] ?? $totalAmount;
            $changeAmount = 0;

            if ($validated['payment_method'] === 'cash') {
                if ($cashReceived < $totalAmount) {
                    return back()->withInput()->with('error', 'Uang tunai yang diterima kurang dari total belanja.');
                }
                $changeAmount = $cashReceived - $totalAmount;
            } else {
                $cashReceived = $totalAmount;
                $changeAmount = 0;
            }

            // Buat record Order
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_id' => null,
                'user_id' => Auth::id(),
                'order_type' => 'ampera',
                'customer_name' => $customerName,
                'customer_phone' => '-',
                'delivery_address' => $serviceLabel,
                'delivery_date' => Carbon::today(),
                'delivery_time' => Carbon::now()->format('H:i:s'),
                'subtotal' => $subtotal,
                'discount_amount' => 0,
                'total_amount' => $totalAmount,
                'cash_received' => $cashReceived,
                'change_amount' => $changeAmount,
                'status' => 'selesai',
                'payment_status' => 'lunas',
                'notes' => $validated['notes'],
            ]);

            // Buat record Order Items
            foreach ($itemsData as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }

            // Buat record Payment langsung lunas & terverifikasi oleh kasir
            $paymentNumber = 'PAY-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            Payment::create([
                'order_id' => $order->id,
                'payment_number' => $paymentNumber,
                'amount' => $totalAmount,
                'payment_method' => $validated['payment_method'],
                'payment_type' => 'full',
                'proof_image' => null,
                'status' => 'diterima',
                'payment_date' => Carbon::now(),
                'verified_by' => Auth::id(),
                'verified_at' => Carbon::now(),
                'notes' => "Transaksi Kasir Ampera ({$serviceLabel}). Uang diterima: Rp " . number_format($cashReceived, 0, ',', '.') . ", Kembalian: Rp " . number_format($changeAmount, 0, ',', '.'),
            ]);

            return redirect()->route('admin.ampera.index', ['last_order' => $order->id])
                ->with('success', "Transaksi Ampera {$order->order_number} berhasil disimpan!");
        });
    }

    public function receipt(Order $order)
    {
        $order->load(['items.menu', 'payments.verifier']);
        return view('admin.ampera.receipt', compact('order'));
    }
}

