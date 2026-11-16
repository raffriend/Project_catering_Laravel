<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CateringPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CateringPackageController extends Controller
{
    public function index()
    {
        $packages = CateringPackage::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_package' => 'required|numeric|min:0',
            'min_order' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'includes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $imagePath = 'img/menu-3.jpg';
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/packages'), $imageName);
            $imagePath = 'uploads/packages/' . $imageName;
        }

        CateringPackage::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . rand(100, 999),
            'description' => $validated['description'],
            'price_per_package' => $validated['price_per_package'],
            'min_order' => $validated['min_order'],
            'image' => $imagePath,
            'includes' => $validated['includes'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket katering baru berhasil ditambahkan.');
    }

    public function edit(CateringPackage $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, CateringPackage $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_package' => 'required|numeric|min:0',
            'min_order' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'includes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $imagePath = $package->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/packages'), $imageName);
            $imagePath = 'uploads/packages/' . $imageName;
        }

        $package->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . $package->id,
            'description' => $validated['description'],
            'price_per_package' => $validated['price_per_package'],
            'min_order' => $validated['min_order'],
            'image' => $imagePath,
            'includes' => $validated['includes'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket katering berhasil diperbarui.');
    }

    public function destroy(CateringPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Paket katering berhasil dihapus.');
    }
}

