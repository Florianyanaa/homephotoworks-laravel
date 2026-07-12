<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => $gallery->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($gallery->title)]); ?>

<?php $galImgPath = $gallery->image ? public_path('uploads/gallery/' . $gallery->image) : null; ?>

<section class="page-hero" style="padding-bottom:0;">
    <div class="container">
        <span class="eyebrow"><a href="<?php echo e(route('galeri')); ?>" style="color:inherit;">&larr; Kembali ke Galeri</a></span>
        <h1><?php echo e($gallery->title); ?></h1>
        <p><?php echo e($gallery->category); ?></p>
    </div>
</section>

<section class="section">
    <div class="container split">
        <img loading="lazy" src="<?php echo e($galImgPath && file_exists($galImgPath) ? asset('uploads/gallery/' . $gallery->image) : asset('img/placeholder-gallery.jpg')); ?>"
             alt="<?php echo e($gallery->title); ?>"
             style="height:520px; object-fit:cover;">
        <div>
            <span class="eyebrow"><?php echo e($gallery->category); ?></span>
            <h2><?php echo e($gallery->title); ?></h2>
            <?php if($gallery->description): ?>
                <p><?php echo e($gallery->description); ?></p>
            <?php else: ?>
                <p>Salah satu momen yang kami abadikan di Home Photoworks. Tertarik dengan konsep serupa untuk sesi foto Anda sendiri?</p>
            <?php endif; ?>
            <a href="<?php echo e(route('layanan')); ?>" class="btn btn-primary" style="margin-top:12px;">Lihat Paket Layanan</a>
        </div>
    </div>
</section>

<?php if($others->isNotEmpty()): ?>
<section class="section section-dark">
    <div class="container">
        <div class="section-head reveal-on-scroll">
            <span class="eyebrow">Lainnya</span>
            <h2>Foto Lain di Galeri</h2>
        </div>
        <div class="gallery-grid">
            <?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $otherImgPath = $g->image ? public_path('uploads/gallery/' . $g->image) : null; ?>
            <a href="<?php echo e(route('galeri.show', $g->id)); ?>"
               class="gallery-item gallery-item-link js-lightbox-trigger reveal-on-scroll"
               data-full="<?php echo e($otherImgPath && file_exists($otherImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>"
               data-title="<?php echo e($g->title); ?>"
               data-category="<?php echo e($g->category); ?>"
               data-detail="<?php echo e(route('galeri.show', $g->id)); ?>">
                <img loading="lazy" src="<?php echo e($otherImgPath && file_exists($otherImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>" alt="<?php echo e($g->title); ?>">
                <div class="gallery-caption">
                    <span><?php echo e($g->category); ?></span>
                    <h4><?php echo e($g->title); ?></h4>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/galeri-detail.blade.php ENDPATH**/ ?>