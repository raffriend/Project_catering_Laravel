<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('is_popular')) {
            $query->where('is_popular', true);
        }

        if ($request->filled('is_daily')) {
            $query->where('is_daily', true);
        }

        $menus = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::where('is_active', true)->get();

        return view('admin.menus.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_daily' => 'boolean',
            'is_popular' => 'boolean',
            'is_available' => 'boolean',
        ], [
            'category_id.required' => 'Pilih kategori menu.',
            'name.required' => 'Nama menu wajib diisi.',
            'price.required' => 'Harga menu wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        $imagePath = 'img/menu-1.jpg'; // default template image
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/menus'), $imageName);
            $imagePath = 'uploads/menus/' . $imageName;
        }

        Menu::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . rand(100, 999),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_daily' => $request->has('is_daily'),
            'is_popular' => $request->has('is_popular'),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan ke katalog.');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_daily' => 'boolean',
            'is_popular' => 'boolean',
            'is_available' => 'boolean',
        ]);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/menus'), $imageName);
            $imagePath = 'uploads/menus/' . $imageName;
        }

        $menu->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . $menu->id,
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_daily' => $request->has('is_daily'),
            'is_popular' => $request->has('is_popular'),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu ' . $menu->name . ' berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus dari sistem.');
    }
}

