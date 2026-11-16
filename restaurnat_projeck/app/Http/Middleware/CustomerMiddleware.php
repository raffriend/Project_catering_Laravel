<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Memastikan user sudah login untuk mengakses dashboard pelanggan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->guest(route('login'))
                ->with('info', 'Silakan masuk ke akun Anda atau daftar akun baru untuk mengakses dashboard pelanggan.');
        }

        return $next($request);
    }
}

