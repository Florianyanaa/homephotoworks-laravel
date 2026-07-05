<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($title ? $title . ' — Home Photoworks' : 'Home Photoworks — Studio Foto Profesional'); ?></title>
<meta name="description" content="Home Photoworks — Studio foto profesional dengan konsep modern dan elegan. Portrait, prewedding, keluarga, produk, hingga maternity.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo e(route('home')); ?>" class="logo">HOME <span>PHOTOWORKS</span></a>

        <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-nav" id="mainNav">
            <a href="<?php echo e(route('home')); ?>">Beranda</a>
            <a href="<?php echo e(route('layanan')); ?>">Layanan</a>
            <a href="<?php echo e(route('galeri')); ?>">Galeri</a>
            <a href="<?php echo e(route('tentang')); ?>">Tentang</a>
            <a href="<?php echo e(route('lokasi')); ?>">Lokasi</a>
            <a href="<?php echo e(route('kontak')); ?>">Kontak</a>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-cta">Dashboard Admin</a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="nav-cta">Dashboard Saya</a>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-logout" style="background:none;border:none;cursor:pointer;">Keluar</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="nav-login">Masuk</a>
                <a href="<?php echo e(route('register')); ?>" class="nav-cta">Daftar</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<?php $flash = session('flash'); ?>
<?php if($flash): ?>
<div class="container">
    <div class="alert alert-<?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div>
</div>
<?php endif; ?>

<?php echo e($slot); ?>


<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <div class="logo">HOME <span>PHOTOWORKS</span></div>
            <p>Mengabadikan momen berharga Anda dengan sentuhan seni yang elegan &amp; profesional sejak hari pertama kami membuka lensa.</p>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <a href="<?php echo e(route('home')); ?>">Beranda</a>
            <a href="<?php echo e(route('layanan')); ?>">Layanan</a>
            <a href="<?php echo e(route('galeri')); ?>">Galeri</a>
            <a href="<?php echo e(route('lokasi')); ?>">Lokasi</a>
            <a href="<?php echo e(route('kontak')); ?>">Kontak</a>
        </div>
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p>+62 852-1040-0454</p>
            <p><a href="https://www.instagram.com/homephotoworks_official?igsh=MTlna2gwcGE0MGNmcQ%3D%3D&utm_source=qr" target="_blank" rel="noopener">@homephotoworks_official</a></p>
        </div>
        <div class="footer-col">
            <h4>Jam Operasional</h4>
            <p>Senin – Minggu: 08.00 – 22.00 WIB</p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            &copy; <?php echo e(date('Y')); ?> Home Photoworks. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>

<div id="lightbox" class="lightbox" aria-hidden="true">
    <button type="button" class="lightbox-close" aria-label="Tutup">&times;</button>
    <button type="button" class="lightbox-nav lightbox-prev" aria-label="Sebelumnya">&#8249;</button>
    <div class="lightbox-content">
        <img id="lightboxImg" src="" alt="">
        <div class="lightbox-caption">
            <span id="lightboxCategory"></span>
            <h4 id="lightboxTitle"></h4>
            <a id="lightboxDetailLink" href="#" class="btn btn-outline btn-sm">Lihat Detail Lengkap &rarr;</a>
        </div>
    </div>
    <button type="button" class="lightbox-nav lightbox-next" aria-label="Berikutnya">&#8250;</button>
</div>

<a href="https://wa.me/6285210400454" target="_blank" rel="noopener" class="whatsapp-float" aria-label="Chat via WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="30" height="30" fill="#ffffff">
        <path d="M16.003 3C9.373 3 4 8.373 4 15.003c0 2.65.87 5.1 2.34 7.09L4.6 28.4l6.47-1.69a11.9 11.9 0 0 0 4.93 1.06h.005c6.63 0 12.003-5.373 12.003-12.003C28.008 8.373 22.633 3 16.003 3Zm0 21.73h-.004a9.7 9.7 0 0 1-4.94-1.35l-.354-.21-3.84 1 1.025-3.744-.23-.384a9.7 9.7 0 0 1-1.487-5.04c0-5.373 4.374-9.746 9.833-9.746 2.627 0 5.096 1.024 6.953 2.884a9.77 9.77 0 0 1 2.877 6.865c0 5.373-4.374 9.725-9.83 9.725Zm5.39-7.29c-.296-.148-1.75-.864-2.02-.963-.27-.1-.468-.148-.665.148-.197.297-.762.963-.934 1.16-.172.198-.344.223-.64.075-.296-.148-1.25-.46-2.38-1.467-.88-.784-1.475-1.753-1.648-2.05-.172-.297-.018-.457.13-.605.134-.133.297-.347.445-.52.148-.174.197-.298.296-.496.098-.198.05-.372-.025-.52-.074-.148-.665-1.6-.91-2.19-.24-.577-.485-.5-.665-.51-.172-.008-.37-.01-.567-.01a1.09 1.09 0 0 0-.79.372c-.271.297-1.035 1.012-1.035 2.468 0 1.456 1.06 2.863 1.207 3.06.148.198 2.086 3.185 5.054 4.466.706.305 1.256.487 1.685.623.708.225 1.352.193 1.86.117.567-.085 1.75-.715 1.997-1.406.247-.69.247-1.283.173-1.406-.074-.124-.27-.198-.567-.347Z"/>
    </svg>
</a>

<script src="<?php echo e(asset('js/SmoothScroll.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/components/layout.blade.php ENDPATH**/ ?>