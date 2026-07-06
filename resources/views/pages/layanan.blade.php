<x-layout title="Layanan">

<section class="page-hero">
    <div class="container page-hero-content">
        <span class="eyebrow">Paket &amp; Layanan</span>
        <h1>Pilih Paket Sesuai Kebutuhan Anda</h1>
        <p>Semua paket sudah termasuk sesi foto studio, pengarahan gaya, dan hasil edit profesional. Klik salah satu paket untuk melihat pilihan Seikhlasnya, Small, Medium, dan Large.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-3">
            @foreach ($services as $s)
            @php $svcImgPath = $s->image ? public_path('uploads/services/' . $s->image) : null; @endphp
            <a href="{{ route('layanan.show', $s->id) }}" class="service-card service-card-link reveal-on-scroll">
                <div class="service-thumb">
                    <img loading="lazy" src="{{ $svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $s->image) : asset('img/placeholder-service.jpg') }}" alt="{{ $s->name }}">
                </div>
                <div class="service-body">
                    <h3>{{ $s->name }}</h3>
                    <p>{{ $s->description }}</p>
                    <div class="service-meta">
                        <span class="price-tag">Mulai Rp {{ number_format($s->price, 0, ',', '.') }}</span>
                        <span class="duration-tag">{{ (int) $s->duration_minutes }} menit</span>
                    </div>
                    <span class="btn btn-outline btn-block">Lihat Pilihan Paket &rarr;</span>
                </div>
            </a>
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
