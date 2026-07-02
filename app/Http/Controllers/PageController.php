<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)->orderBy('id')->limit(3)->get();
        $galleryItems = Gallery::orderByDesc('id')->limit(6)->get();

        $heroDir = public_path('img/hero');
        $heroImages = File::isDirectory($heroDir)
            ? collect(File::files($heroDir))
                ->filter(fn ($f) => in_array(strtolower($f->getExtension()), ['jpg', 'jpeg', 'png', 'webp']))
                ->map(fn ($f) => $f->getFilename())
                ->sort()
                ->values()
            : collect();

        if ($heroImages->isEmpty()) {
            $heroImages = collect(['hero-bg.jpg']); // fallback, ambil dari public/img langsung
        }

        return view('pages.home', compact('services', 'galleryItems', 'heroImages'));
    }

    public function layanan()
    {
        $services = Service::where('is_active', true)->orderBy('id')->get();

        return view('pages.layanan', compact('services'));
    }

    public function layananShow(Service $service)
    {
        abort_unless($service->is_active, 404);

        return view('pages.layanan-detail', compact('service'));
    }

    public function galeri()
    {
        $galleryItems = Gallery::orderByDesc('id')->get();

        return view('pages.galeri', compact('galleryItems'));
    }

    public function tentang()
    {
        return view('pages.tentang');
    }

    public function kontak()
    {
        return view('pages.kontak');
    }
}
