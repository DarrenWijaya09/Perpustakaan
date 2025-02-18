<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Cek apakah email mengandung @gmail.com
            if (str_contains(Auth::user()->email, '@gmail.com')) {
                return $next($request);
            }
        }

        return redirect('/')->withErrors(['message' => 'Akses hanya untuk siswa']);
    }
}
