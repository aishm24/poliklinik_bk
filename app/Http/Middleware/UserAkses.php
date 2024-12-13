<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ambil role pengguna yang sedang login
        $userRole = auth()->user()->role ?? null;

        // Periksa apakah pengguna memiliki salah satu role yang diizinkan
        if (!in_array($userRole, $roles)) {
            return response()->view('errors.403', [
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.',
            ], 403);
        }

        // Lanjutkan ke request berikutnya jika lolos semua pemeriksaan
        return $next($request);
    }
}
