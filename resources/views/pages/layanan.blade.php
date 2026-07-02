<x-layout title="Layanan">

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Paket &amp; Layanan</span>
        <h1>Pilih Paket Sesuai Kebutuhan Anda</h1>
        <p>Semua paket sudah termasuk sesi foto studio, pengarahan gaya, dan hasil edit profesional.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-3">
            @foreach ($services as $s)
            <div class="service-card">
                <div class="service-thumb">
                    <img src="{{ asset('img/placeholder-service.jpg') }}" alt="{{ $s->name }}">
                </div>
                <div class="service-body">
                    <h3>{{ $s->name }}</h3>
                    <p>{{ $s->description }}</p>
                    <div class="service-meta">
                        <span class="price-tag">Rp {{ number_format($s->price, 0, ',', '.') }}</span>
                        <span class="duration-tag">{{ (int) $s->duration_minutes }} menit</span>
                    </div>
                    @auth
                        @if (!auth()->user()->isAdmin())
                            <a href="{{ route('user.booking.create', ['service_id' => $s->id]) }}" class="btn btn-primary btn-block">Booking Paket Ini</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block">Masuk untuk Booking</a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Tidak Yakin Paket Mana yang Cocok?</h2>
        <p>Hubungi tim kami dan konsultasikan kebutuhan sesi foto Anda secara gratis.</p>
        <a href="{{ route('kontak') }}" class="btn btn-light">Hubungi Kami</a>
    </div>
</section>

</x-layout>
