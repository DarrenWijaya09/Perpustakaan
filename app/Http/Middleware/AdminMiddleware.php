<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!Auth::check() || Auth::user()->role !== 'admin' || !str_contains(Auth::user()->email, '@admin.com')) {
        //     abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        // }

        // return $next($request);

        if (!Auth::check() || !str_contains(Auth::user()->email, '@admin.com')) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
