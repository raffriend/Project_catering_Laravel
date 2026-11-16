<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Khusus untuk hak akses Pemilik (Owner / Super Admin).
     * Kasir dilarang melihat laporan total penjualan dan keuangan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!Auth::user()->isOwner()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Akses Ditolak: Laporan total penjualan dan keuangan hanya dapat diakses oleh Pemilik.');
        }

        return $next($request);
    }
}

