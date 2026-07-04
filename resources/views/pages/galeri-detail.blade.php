<x-layout :title="$gallery->title">

@php $galImgPath = $gallery->image ? public_path('uploads/gallery/' . $gallery->image) : null; @endphp

<section class="page-hero" style="padding-bottom:0;">
    <div class="container">
        <span class="eyebrow"><a href="{{ route('galeri') }}" style="color:inherit;">&larr; Kembali ke Galeri</a></span>
        <h1>{{ $gallery->title }}</h1>
        <p>{{ $gallery->category }}</p>
    </div>
</section>

<section class="section">
    <div class="container split">
        <img src="{{ $galImgPath && file_exists($galImgPath) ? asset('uploads/gallery/' . $gallery->image) : asset('img/placeholder-gallery.jpg') }}"
             alt="{{ $gallery->title }}"
             style="height:520px; object-fit:cover;">
        <div>
            <span class="eyebrow">{{ $gallery->category }}</span>
            <h2>{{ $gallery->title }}</h2>
            @if ($gallery->description)
                <p>{{ $gallery->description }}</p>
            @else
                <p>Salah satu momen yang kami abadikan di Home Photoworks. Tertarik dengan konsep serupa untuk sesi foto Anda sendiri?</p>
            @endif
            <a href="{{ route('layanan') }}" class="btn btn-primary" style="margin-top:12px;">Lihat Paket Layanan</a>
        </div>
    </div>
</section>

@if ($others->isNotEmpty())
<section class="section section-dark">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Lainnya</span>
            <h2>Foto Lain di Galeri</h2>
        </div>
        <div class="gallery-grid">
            @foreach ($others as $g)
            @php $otherImgPath = $g->image ? public_path('uploads/gallery/' . $g->image) : null; @endphp
            <a href="{{ route('galeri.show', $g->id) }}"
               class="gallery-item gallery-item-link js-lightbox-trigger"
               data-full="{{ $otherImgPath && file_exists($otherImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}"
               data-title="{{ $g->title }}"
               data-category="{{ $g->category }}"
               data-detail="{{ route('galeri.show', $g->id) }}">
                <img src="{{ $otherImgPath && file_exists($otherImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}" alt="{{ $g->title }}">
                <div class="gallery-caption">
                    <span>{{ $g->category }}</span>
                    <h4>{{ $g->title }}</h4>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

</x-layout>
