@props(['title' => null])
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ? $title . ' — Home Photoworks' : 'Home Photoworks — Studio Foto Profesional' }}</title>
<meta name="description" content="Home Photoworks — Studio foto profesional dengan konsep modern dan elegan. Portrait, prewedding, keluarga, produk, hingga maternity.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="logo">HOME <span>PHOTOWORKS</span></a>

        <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-nav" id="mainNav">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('layanan') }}">Layanan</a>
            <a href="{{ route('galeri') }}">Galeri</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            <a href="{{ route('kontak') }}">Kontak</a>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-cta">Dashboard Admin</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="nav-cta">Dashboard Saya</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-logout" style="background:none;border:none;cursor:pointer;">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-login">Masuk</a>
                <a href="{{ route('register') }}" class="nav-cta">Daftar</a>
            @endauth
        </nav>
    </div>
</header>

@php $flash = session('flash'); @endphp
@if ($flash)
<div class="container">
    <div class="alert alert-{{ $flash['type'] }}">{{ $flash['message'] }}</div>
</div>
@endif

{{ $slot }}

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <div class="logo">HOME <span>PHOTOWORKS</span></div>
            <p>Mengabadikan momen berharga Anda dengan sentuhan seni yang elegan &amp; profesional sejak hari pertama kami membuka lensa.</p>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('layanan') }}">Layanan</a>
            <a href="{{ route('galeri') }}">Galeri</a>
            <a href="{{ route('kontak') }}">Kontak</a>
        </div>
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p>Jl. Seni Fotografi No. 12<br>Tangerang, Banten</p>
            <p>+62 812-3456-7890</p>
            <p>hello@homephotoworks.com</p>
        </div>
        <div class="footer-col">
            <h4>Jam Operasional</h4>
            <p>Senin – Sabtu: 09.00 – 20.00</p>
            <p>Minggu: 10.00 – 17.00</p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            &copy; {{ date('Y') }} Home Photoworks. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
