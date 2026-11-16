<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::withCount('orders')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('customer_type')) {
            $query->where('customer_type', $request->customer_type);
        }

        if ($request->filled('is_regular')) {
            $query->where('is_regular', true);
        }

        $customers = $query->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'customer_type' => 'required|in:individual,institution,catering_langganan',
            'is_regular' => 'boolean',
            'notes' => 'nullable|string',
        ], [
            'name.required' => 'Nama pelanggan wajib diisi.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.unique' => 'Nomor HP ini sudah terdaftar pada pelanggan lain.',
            'address.required' => 'Alamat pelanggan wajib diisi.',
        ]);

        Customer::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'customer_type' => $validated['customer_type'],
            'is_regular' => $request->has('is_regular'),
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['orders.items', 'orders.payments']);
        $totalSpending = $customer->orders->sum('total_amount');
        return view('admin.customers.show', compact('customer', 'totalSpending'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone,' . $customer->id,
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'customer_type' => 'required|in:individual,institution,catering_langganan',
            'is_regular' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $customer->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'customer_type' => $validated['customer_type'],
            'is_regular' => $request->has('is_regular'),
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Data pelanggan ' . $customer->name . ' berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}

