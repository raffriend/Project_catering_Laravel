<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CateringPackage;
use App\Models\Menu;
use App\Models\Promotion;
use App\Models\Testimonial;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $popularMenus = Menu::with('category')
            ->where('is_popular', true)
            ->where('is_available', true)
            ->take(8)
            ->get();

        $cateringPackages = CateringPackage::where('is_active', true)->take(3)->get();

        $activePromos = Promotion::where('is_active', true)
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->get();

        $categories = Category::where('is_active', true)
            ->with(['menus' => function ($q) {
                $q->where('is_available', true)->take(8);
            }])
            ->get();

        $testimonials = Testimonial::active()->latest()->take(8)->get();

        return view('public.home', compact('popularMenus', 'cateringPackages', 'activePromos', 'categories', 'testimonials'));
    }

    public function about()
    {
        $testimonials = Testimonial::active()->latest()->take(6)->get();
        return view('public.about', compact('testimonials'));
    }

    public function catering()
    {
        $packages = CateringPackage::where('is_active', true)->get();
        $promos = Promotion::where('is_active', true)->get();
        return view('public.catering', compact('packages', 'promos'));
    }

    public function promo()
    {
        $promos = Promotion::where('is_active', true)->latest()->get();
        return view('public.promo', compact('promos'));
    }

    public function contact()
    {
        return view('public.contact');
    }
}
