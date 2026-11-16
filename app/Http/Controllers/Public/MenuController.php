<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->with('menus')->get();
        
        $query = Menu::with('category')->where('is_available', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $query->paginate(12)->withQueryString();
        $dailyMenus = Menu::where('is_daily', true)->where('is_available', true)->get();

        return view('public.menu', compact('categories', 'menus', 'dailyMenus'));
    }
}

