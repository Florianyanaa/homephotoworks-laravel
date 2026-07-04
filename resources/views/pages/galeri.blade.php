<x-layout title="Galeri">

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Portofolio</span>
        <h1>Galeri Karya Kami</h1>
        <p>Kumpulan momen yang telah kami abadikan bersama para klien.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if ($galleryItems->isEmpty())
            <div class="empty-state">Belum ada foto di galeri.</div>
        @else
        <div class="gallery-grid">
            @foreach ($galleryItems as $g)
            @php $galImgPath = public_path('uploads/gallery/' . $g->image); @endphp
            <a href="{{ route('galeri.show', $g->id) }}"
               class="gallery-item gallery-item-link js-lightbox-trigger"
               data-full="{{ file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}"
               data-title="{{ $g->title }}"
               data-category="{{ $g->category }}"
               data-detail="{{ route('galeri.show', $g->id) }}">
                <img src="{{ file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}" alt="{{ $g->title }}">
                <div class="gallery-caption">
                    <span>{{ $g->category }}</span>
                    <h4>{{ $g->title }}</h4>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>

</x-layout>
