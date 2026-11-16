<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:promotions,code',
            'description' => 'required|string',
            'promo_type' => 'required|in:bonus,discount',
            'min_order_qty' => 'nullable|integer|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'bonus_description' => 'nullable|string|max:255',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        Promotion::create([
            'title' => $validated['title'],
            'code' => $validated['code'] ? strtoupper($validated['code']) : null,
            'description' => $validated['description'],
            'promo_type' => $validated['promo_type'],
            'min_order_qty' => $validated['min_order_qty'] ?? 0,
            'min_order_amount' => $validated['min_order_amount'] ?? 0,
            'bonus_description' => $validated['bonus_description'],
            'discount_percent' => $validated['discount_percent'],
            'discount_amount' => $validated['discount_amount'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.promotions.index')->with('success', 'Promo & program bonus baru berhasil disimpan.');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:promotions,code,' . $promotion->id,
            'description' => 'required|string',
            'promo_type' => 'required|in:bonus,discount',
            'min_order_qty' => 'nullable|integer|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'bonus_description' => 'nullable|string|max:255',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $promotion->update([
            'title' => $validated['title'],
            'code' => $validated['code'] ? strtoupper($validated['code']) : null,
            'description' => $validated['description'],
            'promo_type' => $validated['promo_type'],
            'min_order_qty' => $validated['min_order_qty'] ?? 0,
            'min_order_amount' => $validated['min_order_amount'] ?? 0,
            'bonus_description' => $validated['bonus_description'],
            'discount_percent' => $validated['discount_percent'],
            'discount_amount' => $validated['discount_amount'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil dihapus.');
    }
}

