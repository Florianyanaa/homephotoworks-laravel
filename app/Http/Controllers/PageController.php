<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)->orderBy('id')->limit(3)->get();
        $galleryItems = Gallery::orderByDesc('id')->limit(6)->get();

        return view('pages.home', compact('services', 'galleryItems'));
    }

    public function layanan()
    {
        $services = Service::where('is_active', true)->orderBy('id')->get();

        return view('pages.layanan', compact('services'));
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
