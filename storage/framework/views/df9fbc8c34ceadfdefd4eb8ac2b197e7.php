<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Tentang Kami']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Tentang Kami']); ?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Tentang Kami</span>
        <h1>Cerita di Balik Home Photoworks</h1>
        <p>Studio foto yang lahir dari kecintaan pada seni visual dan momen manusia.</p>
    </div>
</section>

<section class="section">
    <div class="container split">
        <img loading="lazy" src="<?php echo e(asset('img/placeholder-about.jpg')); ?>" alt="Tim Home Photoworks">
        <div>
            <span class="eyebrow">Perjalanan Kami</span>
            <h2>Dari Studio Kecil Menjadi Rumah Kreativitas</h2>
            <p>Home Photoworks dimulai dari sebuah studio kecil dengan satu set lampu dan semangat besar untuk mengabadikan cerita orang lain. Kini, kami telah melayani lebih dari seribu sesi foto dengan berbagai konsep — dari portrait personal hingga prewedding yang penuh emosi.</p>
            <p>Kami memilih nuansa hitam &amp; putih sebagai identitas visual studio karena percaya bahwa keabadian sebuah momen tidak butuh warna berlebih — cukup cahaya, komposisi, dan ketulusan ekspresi.</p>
            <ul class="checklist">
                <li>Didirikan oleh tim fotografer profesional bersertifikat</li>
                <li>Menggunakan peralatan studio kelas profesional</li>
                <li>Berkomitmen pada kepuasan &amp; kenyamanan klien</li>
            </ul>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Nilai Kami</span>
            <h2>Prinsip yang Kami Pegang</h2>
        </div>
        <div class="grid-3">
            <div class="service-card" style="background:transparent;border-color:#262626;">
                <div class="service-body">
                    <h3 style="color:#fff;">Detail</h3>
                    <p style="color:#b7b7b7;">Setiap sudut cahaya dan komposisi diperhatikan demi hasil yang maksimal.</p>
                </div>
            </div>
            <div class="service-card" style="background:transparent;border-color:#262626;">
                <div class="service-body">
                    <h3 style="color:#fff;">Keaslian</h3>
                    <p style="color:#b7b7b7;">Kami menangkap ekspresi asli, bukan sekadar pose yang dipaksakan.</p>
                </div>
            </div>
            <div class="service-card" style="background:transparent;border-color:#262626;">
                <div class="service-body">
                    <h3 style="color:#fff;">Konsistensi</h3>
                    <p style="color:#b7b7b7;">Standar kualitas yang sama di setiap sesi, besar maupun kecil.</p>
                </div>
            </div>
        </div>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/tentang.blade.php ENDPATH**/ ?>