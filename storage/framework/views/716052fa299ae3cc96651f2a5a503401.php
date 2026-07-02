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
            <a href="<?php echo e(route('kontak')); ?>">Kontak</a>
        </div>
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p>Jl. Seni Fotografi No. 12<br>Tangerang, Banten</p>
            <p>+62 812-3456-7890</p>
            <p>hello@homephotoworks.com</p>
        </div>
        <div class="footer-col">
            <h4>Jam Operasional</h4>
            <p>Senin – Sabtu: 09.00 – 20.00</p>
            <p>Minggu: 10.00 – 17.00</p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            &copy; <?php echo e(date('Y')); ?> Home Photoworks. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>

<script src="<?php echo e(asset('js/main.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/components/layout.blade.php ENDPATH**/ ?>