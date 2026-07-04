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
            <a href="{{ route('admin.messages.index') }}" class="{{ $active === 'messages' ? 'active' : '' }}">✉️ Pesan Masuk</a>
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

<a href="https://wa.me/6285210400454" target="_blank" rel="noopener" class="whatsapp-float" aria-label="Chat via WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="30" height="30" fill="#ffffff">
        <path d="M16.003 3C9.373 3 4 8.373 4 15.003c0 2.65.87 5.1 2.34 7.09L4.6 28.4l6.47-1.69a11.9 11.9 0 0 0 4.93 1.06h.005c6.63 0 12.003-5.373 12.003-12.003C28.008 8.373 22.633 3 16.003 3Zm0 21.73h-.004a9.7 9.7 0 0 1-4.94-1.35l-.354-.21-3.84 1 1.025-3.744-.23-.384a9.7 9.7 0 0 1-1.487-5.04c0-5.373 4.374-9.746 9.833-9.746 2.627 0 5.096 1.024 6.953 2.884a9.77 9.77 0 0 1 2.877 6.865c0 5.373-4.374 9.725-9.83 9.725Zm5.39-7.29c-.296-.148-1.75-.864-2.02-.963-.27-.1-.468-.148-.665.148-.197.297-.762.963-.934 1.16-.172.198-.344.223-.64.075-.296-.148-1.25-.46-2.38-1.467-.88-.784-1.475-1.753-1.648-2.05-.172-.297-.018-.457.13-.605.134-.133.297-.347.445-.52.148-.174.197-.298.296-.496.098-.198.05-.372-.025-.52-.074-.148-.665-1.6-.91-2.19-.24-.577-.485-.5-.665-.51-.172-.008-.37-.01-.567-.01a1.09 1.09 0 0 0-.79.372c-.271.297-1.035 1.012-1.035 2.468 0 1.456 1.06 2.863 1.207 3.06.148.198 2.086 3.185 5.054 4.466.706.305 1.256.487 1.685.623.708.225 1.352.193 1.86.117.567-.085 1.75-.715 1.997-1.406.247-.69.247-1.283.173-1.406-.074-.124-.27-.198-.567-.347Z"/>
    </svg>
</a>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
