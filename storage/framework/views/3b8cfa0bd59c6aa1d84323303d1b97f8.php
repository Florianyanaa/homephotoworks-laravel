<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Layanan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Layanan']); ?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Paket &amp; Layanan</span>
        <h1>Pilih Paket Sesuai Kebutuhan Anda</h1>
        <p>Semua paket sudah termasuk sesi foto studio, pengarahan gaya, dan hasil edit profesional. Klik salah satu paket untuk melihat pilihan Seikhlasnya, Small, Medium, dan Large.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-3">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $svcImgPath = $s->image ? public_path('uploads/services/' . $s->image) : null; ?>
            <a href="<?php echo e(route('layanan.show', $s->id)); ?>" class="service-card service-card-link">
                <div class="service-thumb">
                    <img src="<?php echo e($svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $s->image) : asset('img/placeholder-service.jpg')); ?>" alt="<?php echo e($s->name); ?>">
                </div>
                <div class="service-body">
                    <h3><?php echo e($s->name); ?></h3>
                    <p><?php echo e($s->description); ?></p>
                    <div class="service-meta">
                        <span class="price-tag">Mulai Rp <?php echo e(number_format($s->price, 0, ',', '.')); ?></span>
                        <span class="duration-tag"><?php echo e((int) $s->duration_minutes); ?> menit</span>
                    </div>
                    <span class="btn btn-outline btn-block">Lihat Pilihan Paket &rarr;</span>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Tidak Yakin Paket Mana yang Cocok?</h2>
        <p>Hubungi tim kami dan konsultasikan kebutuhan sesi foto Anda secara gratis.</p>
        <a href="<?php echo e(route('kontak')); ?>" class="btn btn-light">Hubungi Kami</a>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/layanan.blade.php ENDPATH**/ ?>