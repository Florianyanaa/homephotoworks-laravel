<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Beranda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Beranda']); ?>

<section class="hero">
    <div class="hero-bg-slider">
        <?php $__currentLoopData = $heroImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="hero-slide <?php echo e($i === 0 ? 'active' : ''); ?>" style="background-image:url('<?php echo e(asset('img/hero/'.$img)); ?>')"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="container hero-content">
        <span class="eyebrow">Home Photoworks</span>
        <h1>Abadikan Momen dengan Sentuhan Elegan</h1>
        <p>Home Photoworks menghadirkan pengalaman fotografi studio modern — memadukan pencahayaan profesional, komposisi artistik, dan hasil akhir yang timeless dalam nuansa monokrom.</p>
        <div class="hero-actions">
            <a href="<?php echo e(route('layanan')); ?>" class="btn btn-light">Lihat Paket Layanan</a>
            <a href="<?php echo e(route('galeri')); ?>" class="btn btn-light">Jelajahi Galeri</a>
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
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $svcImgPath = $s->image ? public_path('uploads/services/' . $s->image) : null; ?>
            <div class="service-card">
                <div class="service-thumb">
                    <img src="<?php echo e($svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $s->image) : asset('img/placeholder-service.jpg')); ?>" alt="<?php echo e($s->name); ?>">
                </div>
                <div class="service-body">
                    <h3><?php echo e($s->name); ?></h3>
                    <p><?php echo e(\Illuminate\Support\Str::limit($s->description, 100)); ?></p>
                    <div class="service-meta">
                        <span class="price-tag">Rp <?php echo e(number_format($s->price, 0, ',', '.')); ?></span>
                        <span class="duration-tag"><?php echo e((int) $s->duration_minutes); ?> menit</span>
                    </div>
                    <a href="<?php echo e(route('layanan.show', $s->id)); ?>" class="btn btn-outline btn-block">Detail Paket</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Galeri Karya</span>
            <h2>Cuplikan Hasil Sesi Foto</h2>
            <p>Sebagian kecil dari karya yang telah kami hasilkan bersama para klien.</p>
        </div>
        <div class="gallery-grid">
            <?php $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $galImgPath = public_path('uploads/gallery/' . $g->image); ?>
            <a href="<?php echo e(route('galeri.show', $g->id)); ?>"
               class="gallery-item gallery-item-link js-lightbox-trigger"
               data-full="<?php echo e(file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>"
               data-title="<?php echo e($g->title); ?>"
               data-category="<?php echo e($g->category); ?>"
               data-detail="<?php echo e(route('galeri.show', $g->id)); ?>">
                <img src="<?php echo e(file_exists($galImgPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>" alt="<?php echo e($g->title); ?>">
                <div class="gallery-caption">
                    <span><?php echo e($g->category); ?></span>
                    <h4><?php echo e($g->title); ?></h4>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div style="text-align:center; margin-top: 44px;">
            <a href="<?php echo e(route('galeri')); ?>" class="btn btn-outline">Lihat Semua Galeri</a>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Siap Mengabadikan Momen Anda?</h2>
        <p>Buat akun dan pesan sesi foto pertama Anda hari ini juga.</p>
        <a href="<?php echo e(auth()->check() ? route('user.booking.create') : route('register')); ?>" class="btn btn-light">Booking Sekarang</a>
    </div>
</section>

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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/home.blade.php ENDPATH**/ ?>