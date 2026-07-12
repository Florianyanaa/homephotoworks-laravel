<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Lokasi Kami']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Lokasi Kami']); ?>

<?php
$branches = [
    [
        'name' => 'Cabang Bekasi',
        'address' => 'Rukan Grand Galaxy City Blok RSA 2 No. 16, RT.002/RW.002, Jaka Setia, Kec. Bekasi Sel., Kota Bks, Jawa Barat 17147',
    ],
    [
        'name' => 'Cabang Kelapa Gading',
        'address' => 'Jl. Gading Griya Lestari Raya No.H1/35, RT.1/RW.9, Sukapura, Kec. Cilincing, Jkt Utara, Daerah Khusus Ibukota Jakarta 14140',
    ],
    [
        'name' => 'Cabang Bogor',
        'address' => 'Braja Mustika Hotel, Komplek Ruko Jl. DR. Sumeru No.22, RT.01/RW.01, Menteng, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16143',
    ],
    [
        'name' => 'Cabang Pusat Tangerang',
        'address' => 'Jl. Bahagia Raya No.4 No.d3, RT.004/RW.003, Gebang Raya, Kec. Periuk, Kota Tangerang, Banten 15132',
    ],
];
?>

<section class="page-hero">
    <div class="container page-hero-content">
        <span class="eyebrow">Cabang Kami</span>
        <h1>Lokasi Kami</h1>
        <p>Home Photoworks hadir di 4 kota — pilih cabang terdekat dari lokasi Anda.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-3 grid-4">
            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="service-card location-card">
                <div class="location-map">
                    <iframe
                        src="<?php echo e('https://www.google.com/maps?q=' . urlencode($b['address']) . '&output=embed'); ?>"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>
                <div class="service-body">
                    <h3><?php echo e($b['name']); ?></h3>
                    <p><?php echo e($b['address']); ?></p>
                    <a href="<?php echo e('https://www.google.com/maps/search/?api=1&query=' . urlencode($b['address'])); ?>" target="_blank" rel="noopener" class="btn btn-outline btn-block">Buka Maps</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Siap Booking Sesi Foto Anda?</h2>
        <p>Pilih cabang terdekat, lalu hubungi kami via WhatsApp untuk booking paket favoritmu.</p>
        <a href="<?php echo e(route('layanan')); ?>" class="btn btn-light">Lihat Paket Layanan</a>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/lokasi.blade.php ENDPATH**/ ?>