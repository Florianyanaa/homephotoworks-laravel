@props(['title' => 'Dashboard', 'active' => '', 'role' => 'user'])
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }} — Home Photoworks</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="dash-wrap">
    <aside class="dash-sidebar">
        <div class="logo">HOME <span>PHOTOWORKS</span></div>
        <span class="dash-role">{{ $role === 'admin' ? 'Panel Admin' : 'Area Pengguna' }}</span>

        <nav class="dash-nav">
        @if ($role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="{{ $active === 'dashboard' ? 'active' : '' }}">📊 Dashboard</a>
            <a href="{{ route('admin.bookings.index') }}" class="{{ $active === 'bookings' ? 'active' : '' }}">🗓️ Pemesanan</a>
            <a href="{{ route('admin.services.index') }}" class="{{ $active === 'services' ? 'active' : '' }}">📷 Layanan</a>
            <a href="{{ route('admin.gallery.index') }}" class="{{ $active === 'gallery' ? 'active' : '' }}">🖼️ Galeri</a>
            <a href="{{ route('admin.users.index') }}" class="{{ $active === 'users' ? 'active' : '' }}">👥 Pengguna</a>
            <div class="divider"></div>
            <a href="{{ route('home') }}">🌐 Lihat Website</a>
        @else
            <a href="{{ route('user.dashboard') }}" class="{{ $active === 'dashboard' ? 'active' : '' }}">📊 Dashboard</a>
            <a href="{{ route('user.booking.create') }}" class="{{ $active === 'booking' ? 'active' : '' }}">➕ Booking Baru</a>
            <a href="{{ route('user.my-bookings') }}" class="{{ $active === 'my_bookings' ? 'active' : '' }}">🗓️ Pemesanan Saya</a>
            <a href="{{ route('user.profile') }}" class="{{ $active === 'profile' ? 'active' : '' }}">👤 Profil</a>
            <div class="divider"></div>
            <a href="{{ route('home') }}">🌐 Lihat Website</a>
        @endif
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dash-logout-form').submit();">🚪 Keluar</a>
            <form id="dash-logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                @csrf
            </form>
        </nav>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <h1>{{ $title }}</h1>
            <div class="user-chip">👋 {{ auth()->user()->full_name ?? '' }}</div>
        </div>

        @php $flash = session('flash'); @endphp
        @if ($flash)
            <div class="alert alert-{{ $flash['type'] }}">{{ $flash['message'] }}</div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">{{ $error }}</div>
            @endforeach
        @endif

        {{ $slot }}
    </main>
</div>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
