<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Statistik Utama
        $ordersToday = Order::whereDate('created_at', $today)->count();
        $pendingOrders = Order::where('status', 'masuk')->count();
        $pendingPayments = Payment::where('status', 'menunggu_konfirmasi')->count();
        $revenueToday = Payment::where('status', 'diterima')
            ->whereDate('payment_date', $today)
            ->sum('amount');

        // Total Counts
        $totalMenus = Menu::count();
        $totalCategories = Category::count();
        $totalCustomers = Customer::count();
        $totalRevenue = Payment::where('status', 'diterima')->sum('amount');

        // Pesanan Terbaru (5 teratas)
        $recentOrders = Order::with(['items', 'customer', 'payments'])
            ->latest()
            ->take(6)
            ->get();

        // Menu Terlaris (berdasarkan agregasi order_items)
        $topMenus = DB::table('order_items')
            ->select('item_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
            ->groupBy('item_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // Data Grafik 7 Hari Terakhir
        $chartDates = [];
        $chartOrders = [];
        $chartRevenue = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $dateLabel = $date->translatedFormat('d M');

            $chartDates[] = $dateLabel;
            $chartOrders[] = Order::whereDate('created_at', $dateStr)->count();
            $chartRevenue[] = (float) Payment::where('status', 'diterima')
                ->whereDate('payment_date', $dateStr)
                ->sum('amount');
        }

        return view('admin.dashboard', compact(
            'ordersToday',
            'pendingOrders',
            'pendingPayments',
            'revenueToday',
            'totalMenus',
            'totalCategories',
            'totalCustomers',
            'totalRevenue',
            'recentOrders',
            'topMenus',
            'chartDates',
            'chartOrders',
            'chartRevenue'
        ));
    }
}

