<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'monthly'); // daily, weekly, monthly, custom
        $today = Carbon::today();

        $startDate = match($period) {
            'daily' => $today->copy()->startOfDay(),
            'weekly' => $today->copy()->startOfWeek(),
            'monthly' => $today->copy()->startOfMonth(),
            'custom' => $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : $today->copy()->startOfMonth(),
            default => $today->copy()->startOfMonth(),
        };

        $endDate = match($period) {
            'daily' => $today->copy()->endOfDay(),
            'weekly' => $today->copy()->endOfWeek(),
            'monthly' => $today->copy()->endOfMonth(),
            'custom' => $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : $today->copy()->endOfMonth(),
            default => $today->copy()->endOfMonth(),
        };

        // Query Orders in Period
        $orders = Order::with(['items', 'customer', 'payments'])
            ->whereBetween('delivery_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->latest()
            ->get();

        // Statistics
        $totalOrdersCount = $orders->count();
        $completedOrdersCount = $orders->where('status', 'selesai')->count();
        $totalSalesAmount = $orders->sum('total_amount');

        // Revenue from verified payments in period
        $totalRevenueCollected = Payment::where('status', 'diterima')
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->sum('amount');

        // Pending payments (uncollected)
        $pendingPaymentsCount = Payment::where('status', 'menunggu_konfirmasi')->count();
        $unpaidOrdersAmount = $orders->where('payment_status', '!=', 'lunas')->sum('total_amount');

        // Best-selling menu items in period
        $topSellingMenus = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.delivery_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->select('order_items.item_name', DB::raw('SUM(order_items.quantity) as total_qty'), DB::raw('SUM(order_items.subtotal) as total_sales'))
            ->groupBy('order_items.item_name')
            ->orderByDesc('total_qty')
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact(
            'period',
            'startDate',
            'endDate',
            'orders',
            'totalOrdersCount',
            'completedOrdersCount',
            'totalSalesAmount',
            'totalRevenueCollected',
            'pendingPaymentsCount',
            'unpaidOrdersAmount',
            'topSellingMenus'
        ));
    }
}

