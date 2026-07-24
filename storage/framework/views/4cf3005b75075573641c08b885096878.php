<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => $service->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service->name)]); ?>

<?php $svcImgPath = $service->image ? public_path('uploads/services/' . $service->image) : null; ?>

<section class="page-hero" style="padding-bottom:0;">
    <div class="container">
        <span class="eyebrow"><a href="<?php echo e(route('layanan')); ?>" style="color:inherit;">&larr; Kembali ke Layanan</a></span>
        <h1><?php echo e($service->name); ?></h1>
        <p><?php echo e($service->description); ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <img loading="lazy" src="<?php echo e($svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $service->image) : asset('img/placeholder-service.jpg')); ?>"
             alt="<?php echo e($service->name); ?>"
             style="width:100%; max-height:420px; object-fit:cover; border-radius: var(--radius); margin-bottom:48px;">

        <div class="section-head reveal-on-scroll">
            <span class="eyebrow">Pilih Sub-Paket</span>
            <h2>Sesuaikan dengan Kebutuhan &amp; Budget Anda</h2>
            <p>Setiap sub-paket punya cakupan berbeda dari layanan "<?php echo e($service->name); ?>" di atas.</p>
        </div>

        <div class="grid-3" style="align-items:stretch;">
            <?php $__currentLoopData = $service->tiers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="service-card reveal-on-scroll" style="display:flex; flex-direction:column;">
                <div class="service-body" style="display:flex; flex-direction:column; flex:1;">
                    <h3><?php echo e($tier['label']); ?></h3>
                    <p style="min-height:80px;"><?php echo e($tier['description']); ?></p>
                    <div class="service-meta" style="margin-top:auto;">
                        <?php if($tier['price'] === null): ?>
                            <span class="price-tag" style="font-size:17px;">Sesuai Keikhlasan</span>
                        <?php else: ?>
                            <span class="price-tag">Rp <?php echo e(number_format($tier['price'], 0, ',', '.')); ?></span>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('kontak')); ?>" class="btn btn-primary btn-block">Tanya Paket Ini</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Masih Bingung Pilih Sub-Paket?</h2>
        <p>Konsultasikan kebutuhan foto Anda dulu, tim kami bantu rekomendasikan yang paling pas.</p>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/layanan-detail.blade.php ENDPATH**/ ?>