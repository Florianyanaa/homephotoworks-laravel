<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Dashboard', 'active' => '', 'role' => 'user']));

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

foreach (array_filter((['title' => 'Dashboard', 'active' => '', 'role' => 'user']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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
<title><?php echo e($title); ?> — Home Photoworks</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="dash-wrap">
    <aside class="dash-sidebar">
        <div class="logo">HOME <span>PHOTOWORKS</span></div>
        <span class="dash-role"><?php echo e($role === 'admin' ? 'Panel Admin' : 'Area Pengguna'); ?></span>

        <nav class="dash-nav">
        <?php if($role === 'admin'): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e($active === 'dashboard' ? 'active' : ''); ?>">📊 Dashboard</a>
            <a href="<?php echo e(route('admin.bookings.index')); ?>" class="<?php echo e($active === 'bookings' ? 'active' : ''); ?>">🗓️ Pemesanan</a>
            <a href="<?php echo e(route('admin.services.index')); ?>" class="<?php echo e($active === 'services' ? 'active' : ''); ?>">📷 Layanan</a>
            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="<?php echo e($active === 'gallery' ? 'active' : ''); ?>">🖼️ Galeri</a>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php echo e($active === 'users' ? 'active' : ''); ?>">👥 Pengguna</a>
            <div class="divider"></div>
            <a href="<?php echo e(route('home')); ?>">🌐 Lihat Website</a>
        <?php else: ?>
            <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e($active === 'dashboard' ? 'active' : ''); ?>">📊 Dashboard</a>
            <a href="<?php echo e(route('user.booking.create')); ?>" class="<?php echo e($active === 'booking' ? 'active' : ''); ?>">➕ Booking Baru</a>
            <a href="<?php echo e(route('user.my-bookings')); ?>" class="<?php echo e($active === 'my_bookings' ? 'active' : ''); ?>">🗓️ Pemesanan Saya</a>
            <a href="<?php echo e(route('user.profile')); ?>" class="<?php echo e($active === 'profile' ? 'active' : ''); ?>">👤 Profil</a>
            <div class="divider"></div>
            <a href="<?php echo e(route('home')); ?>">🌐 Lihat Website</a>
        <?php endif; ?>
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('dash-logout-form').submit();">🚪 Keluar</a>
            <form id="dash-logout-form" method="POST" action="<?php echo e(route('logout')); ?>" style="display:none;">
                <?php echo csrf_field(); ?>
            </form>
        </nav>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <h1><?php echo e($title); ?></h1>
            <div class="user-chip">👋 <?php echo e(auth()->user()->full_name ?? ''); ?></div>
        </div>

        <?php $flash = session('flash'); ?>
        <?php if($flash): ?>
            <div class="alert alert-<?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-error"><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>

    </main>
</div>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/components/dash-layout.blade.php ENDPATH**/ ?>