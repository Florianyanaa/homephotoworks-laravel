<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class ComingSoonMode
{
    /**
     * Kalau mode coming-soon aktif, semua pengunjung publik akan melihat
     * halaman countdown, kecuali:
     * - Admin yang sudah login (supaya tetap bisa cek-cek web asli)
     * - Halaman login & proses login (supaya admin bisa masuk)
     * - Semua halaman di dalam /admin (panel admin tetap jalan seperti biasa)
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('comingsoon.enabled')) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        if ($request->routeIs('login') || $request->routeIs('login.attempt') || $request->routeIs('logout')) {
            return $next($request);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        // Pakai foto yang sama seperti slideshow hero di halaman Beranda
        $heroDir = public_path('img/hero');
        $heroImages = File::isDirectory($heroDir)
            ? collect(File::files($heroDir))
                ->filter(fn ($f) => in_array(strtolower($f->getExtension()), ['jpg', 'jpeg', 'png', 'webp']))
                ->map(fn ($f) => $f->getFilename())
                ->sort()
                ->values()
            : collect();

        if ($heroImages->isEmpty()) {
            $heroImages = collect(['hero-bg.jpg']);
        }

        return response()->view('coming-soon', [
            'launchAt' => config('comingsoon.launch_at'),
            'heroImages' => $heroImages,
        ]);
    }
}
