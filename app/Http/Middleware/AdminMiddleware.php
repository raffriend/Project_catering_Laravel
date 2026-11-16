<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request for manager/admin area.
     * Dapat diakses oleh Pemilik (Owner/Admin) dan Kasir.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses dashboard manager.');
        }

        if (!Auth::user()->isManager()) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Akses ditolak. Halaman tersebut khusus untuk staf pengelola (Pemilik & Kasir).');
        }

        return $next($request);
    }
}
