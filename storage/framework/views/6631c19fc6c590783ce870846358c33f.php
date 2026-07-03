<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Kontak']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kontak']); ?>

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Hubungi Kami</span>
        <h1>Mari Diskusikan Sesi Foto Anda</h1>
        <p>Tim kami siap membantu menjawab pertanyaan seputar layanan &amp; jadwal.</p>
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div>
            <span class="eyebrow">Informasi</span>
            <h2 style="margin-bottom: 26px;">Detail Kontak Studio</h2>

            <div class="contact-info-item">
                <h4>Telepon / WhatsApp</h4>
                <p>+62 852-1040-0454</p>
            </div>
            <div class="contact-info-item">
                <h4>Instagram</h4>
                <p><a href="https://www.instagram.com/homephotoworks_official?igsh=MTlna2gwcGE0MGNmcQ%3D%3D&utm_source=qr" target="_blank" rel="noopener">@homephotoworks_official</a></p>
            </div>
            <div class="contact-info-item">
                <h4>Jam Operasional</h4>
                <p>Senin – Minggu: 08.00 – 22.00 WIB</p>
            </div>
        </div>

        <div class="panel" style="margin-bottom:0;">
            <h2 style="margin-bottom:20px;">Kirim Pesan</h2>
            <form method="post" action="#" onsubmit="alert('Terima kasih! Pesan Anda telah dicatat (demo form).'); return false;">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="email@contoh.com" required>
                </div>
                <div class="form-group">
                    <label>Pesan</label>
                    <textarea rows="5" placeholder="Tuliskan pertanyaan atau kebutuhan Anda..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
            </form>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/pages/kontak.blade.php ENDPATH**/ ?>