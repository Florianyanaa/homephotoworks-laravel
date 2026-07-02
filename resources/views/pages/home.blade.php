<x-layout title="Beranda">

<section class="hero">
    <div class="hero-bg-slider">
        @foreach ($heroImages as $i => $img)
        <div class="hero-slide {{ $i === 0 ? 'active' : '' }}" style="background-image:url('{{ asset('img/hero/'.$img) }}')"></div>
        @endforeach
    </div>
    <div class="container hero-content">
        <span class="eyebrow">Home Photoworks</span>
        <h1>Abadikan Momen dengan Sentuhan Elegan</h1>
        <p>Home Photoworks menghadirkan pengalaman fotografi studio modern — memadukan pencahayaan profesional, komposisi artistik, dan hasil akhir yang timeless dalam nuansa monokrom.</p>
        <div class="hero-actions">
            <a href="{{ route('layanan') }}" class="btn btn-light">Lihat Paket Layanan</a>
            <a href="{{ route('galeri') }}" class="btn btn-light">Jelajahi Galeri</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Layanan Kami</span>
            <h2>Paket Fotografi Pilihan</h2>
            <p>Setiap paket dirancang dengan konsep dan pendekatan berbeda, disesuaikan dengan kebutuhan momen Anda.</p>
        </div>
        <div class="grid-3">
            @foreach ($services as $s)
            @php $svcImgPath = $s->image ? public_path('uploads/services/' . $s->image) : null; @endphp
            <div class="service-card">
                <div class="service-thumb">
                    <img src="{{ $svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $s->image) : asset('img/placeholder-service.jpg') }}" alt="{{ $s->name }}">
                </div>
                <div class="service-body">
                    <h3>{{ $s->name }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($s->description, 100) }}</p>
                    <div class="service-meta">
                        <span class="price-tag">Rp {{ number_format($s->price, 0, ',', '.') }}</span>
                        <span class="duration-tag">{{ (int) $s->duration_minutes }} menit</span>
                    </div>
                    <a href="{{ route('layanan.show', $s->id) }}" class="btn btn-outline btn-block">Detail Paket</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Galeri Karya</span>
            <h2>Cuplikan Hasil Sesi Foto</h2>
            <p>Sebagian kecil dari karya yang telah kami hasilkan bersama para klien.</p>
        </div>
        <div class="gallery-grid">
            @foreach ($galleryItems as $g)
            @php $galImgPath = public_path('uploads/gallery/' . $g->image); @endphp
            <div class="gallery-item">
                <img src="{{ file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}" alt="{{ $g->title }}">
                <div class="gallery-caption">
                    <span>{{ $g->category }}</span>
                    <h4>{{ $g->title }}</h4>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top: 44px;">
            <a href="{{ route('galeri') }}" class="btn btn-light">Lihat Semua Galeri</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <img src="{{ asset('img/placeholder-about.jpg') }}" alt="Studio Home Photoworks">
        <div>
            <span class="eyebrow">Kenapa Memilih Kami</span>
            <h2>Studio dengan Standar Profesional &amp; Sentuhan Personal</h2>
            <p>Kami percaya setiap foto adalah cerita. Tim fotografer kami menggabungkan teknik pencahayaan studio kelas atas dengan pendekatan personal untuk menghasilkan gambar yang tak hanya indah, tapi juga bermakna.</p>
            <ul class="checklist">
                <li>Peralatan &amp; pencahayaan studio profesional</li>
                <li>Fotografer berpengalaman di berbagai konsep</li>
                <li>Proses booking online yang mudah &amp; cepat</li>
                <li>Hasil edit foto berkualitas tinggi</li>
            </ul>
            <br>
            <a href="{{ route('tentang') }}" class="btn btn-primary">Selengkapnya Tentang Kami</a>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Siap Mengabadikan Momen Anda?</h2>
        <p>Buat akun dan pesan sesi foto pertama Anda hari ini juga.</p>
        <a href="{{ auth()->check() ? route('user.booking.create') : route('register') }}" class="btn btn-light">Booking Sekarang</a>
    </div>
</section>

</x-layout>
