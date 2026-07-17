<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Galeri']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Galeri']); ?>

<section class="page-hero">
    <div class="container page-hero-content">
        <span class="eyebrow">Portofolio</span>
        <h1>Galeri Karya Kami</h1>
        <p>Kumpulan momen yang telah kami abadikan bersama para klien.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if($galleryItems->isEmpty()): ?>
            <div class="empty-state">Belum ada foto di galeri.</div>
        <?php else: ?>
        <?php $categories = $galleryItems->pluck('category')->filter()->unique()->sort()->values(); ?>
        <?php if($categories->count() > 1): ?>
        <div class="gallery-filter" id="galleryFilter">
            <button type="button" class="gallery-filter-btn active" data-filter="all">Semua</button>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="gallery-filter-btn" data-filter="<?php echo e($cat); ?>"><?php echo e($cat); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <div class="gallery-grid" id="galleryGrid">
            <?php $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $galImgPath = public_path('uploads/gallery/' . $g->image); ?>
            <a href="<?php echo e(route('galeri.show', $g->id)); ?>"
               class="gallery-item gallery-item-link js-lightbox-trigger reveal-on-scroll"
               data-full="<?php echo e(file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>"
               data-title="<?php echo e($g->title); ?>"
               data-category="<?php echo e($g->category); ?>"
               data-detail="<?php echo e(route('galeri.show', $g->id)); ?>">
                <img loading="lazy" src="<?php echo e(file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>" alt="<?php echo e($g->title); ?>">
                <div class="gallery-caption">
                    <span><?php echo e($g->category); ?></span>
                    <h4><?php echo e($g->title); ?></h4>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p class="gallery-empty-filter" id="galleryEmptyFilter" style="display:none;">Belum ada foto untuk kategori ini.</p>
        <?php endif; ?>
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


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/galeri.blade.php ENDPATH**/ ?>