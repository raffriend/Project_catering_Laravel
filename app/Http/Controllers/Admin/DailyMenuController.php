<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class DailyMenuController extends Controller
{
    public function index(Request $request)
    {
        $query = DailyMenu::with('menu.category')->latest();

        if ($request->filled('day_of_week')) {
            $query->where('day_of_week', $request->day_of_week);
        }

        $dailyMenus = $query->paginate(15)->withQueryString();
        $menus = Menu::where('is_available', true)->get();

        return view('admin.daily-menus.index', compact('dailyMenus', 'menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'day_of_week' => 'required|string',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        DailyMenu::create([
            'menu_id' => $validated['menu_id'],
            'day_of_week' => $validated['day_of_week'],
            'notes' => $validated['notes'],
            'is_active' => $request->has('is_active'),
        ]);

        // Also mark menu as is_daily = true
        Menu::where('id', $validated['menu_id'])->update(['is_daily' => true]);

        return redirect()->route('admin.daily-menus.index')->with('success', 'Menu harian berhasil ditambahkan.');
    }

    public function destroy(DailyMenu $dailyMenu)
    {
        $dailyMenu->delete();
        return redirect()->route('admin.daily-menus.index')->with('success', 'Jadwal menu harian berhasil dihapus.');
    }
}

