<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['order', 'verifier'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('payment_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('payment_date', '<=', $request->date_to);
        }

        $payments = $query->paginate(15)->withQueryString();
        $pendingCount = Payment::where('status', 'menunggu_konfirmasi')->count();

        return view('admin.payments.index', compact('payments', 'pendingCount'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['order.items', 'order.customer', 'verifier']);
        return view('admin.payments.show', compact('payment'));
    }

    public function verify(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'notes' => 'nullable|string',
        ]);

        $payment->update([
            'status' => $validated['status'],
            'verified_by' => Auth::id(),
            'verified_at' => Carbon::now(),
            'notes' => $validated['notes'] ?? $payment->notes,
        ]);

        // If payment is accepted, update order's payment_status
        if ($validated['status'] === 'diterima') {
            $order = $payment->order;
            
            // Calculate total accepted payments
            $totalPaid = Payment::where('order_id', $order->id)
                ->where('status', 'diterima')
                ->sum('amount');

            if ($totalPaid >= $order->total_amount) {
                $order->update(['payment_status' => 'lunas']);
            } elseif ($totalPaid > 0) {
                $order->update(['payment_status' => 'dp']);
            }
        }

        return redirect()->route('admin.payments.index')
            ->with('success', 'Status pembayaran ' . $payment->payment_number . ' berhasil di-' . $validated['status'] . '.');
    }
}

