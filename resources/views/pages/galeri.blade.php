<x-layout title="Galeri">

<section class="page-hero">
    <div class="container page-hero-content">
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
        @php $categories = $galleryItems->pluck('category')->filter()->unique()->sort()->values(); @endphp
        @if ($categories->count() > 1)
        <div class="gallery-filter" id="galleryFilter">
            <button type="button" class="gallery-filter-btn active" data-filter="all">Semua</button>
            @foreach ($categories as $cat)
                <button type="button" class="gallery-filter-btn" data-filter="{{ $cat }}">{{ $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="gallery-grid" id="galleryGrid">
            @foreach ($galleryItems as $g)
            @php $galImgPath = public_path('uploads/gallery/' . $g->image); @endphp
            <a href="{{ route('galeri.show', $g->id) }}"
               class="gallery-item gallery-item-link js-lightbox-trigger reveal-on-scroll"
               data-full="{{ file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}"
               data-title="{{ $g->title }}"
               data-category="{{ $g->category }}"
               data-detail="{{ route('galeri.show', $g->id) }}">
                <img loading="lazy" src="{{ file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}" alt="{{ $g->title }}">
                <div class="gallery-caption">
                    <span>{{ $g->category }}</span>
                    <h4>{{ $g->title }}</h4>
                </div>
            </a>
            @endforeach
        </div>
        <p class="gallery-empty-filter" id="galleryEmptyFilter" style="display:none;">Belum ada foto untuk kategori ini.</p>
        @endif
    </div>
</section>

<script>
(function () {
    var filterBar = document.getElementById('galleryFilter');
    if (!filterBar) return;

    var buttons = filterBar.querySelectorAll('.gallery-filter-btn');
    var items = document.querySelectorAll('#galleryGrid .gallery-item');
    var emptyMsg = document.getElementById('galleryEmptyFilter');

    filterBar.addEventListener('click', function (e) {
        var btn = e.target.closest('.gallery-filter-btn');
        if (!btn) return;

        buttons.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        var filter = btn.getAttribute('data-filter');
        var visibleCount = 0;

        items.forEach(function (item) {
            var match = filter === 'all' || item.getAttribute('data-category') === filter;
            item.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        emptyMsg.style.display = visibleCount === 0 ? 'block' : 'none';
    });
})();
</script>


</x-layout>
