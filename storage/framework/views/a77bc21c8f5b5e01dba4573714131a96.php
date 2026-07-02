<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Dashboard Saya','active' => 'dashboard','role' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Saya','active' => 'dashboard','role' => 'user']); ?>

<div class="cards-row">
    <div class="stat-card"><div class="num"><?php echo e((int) $totalBookings); ?></div><div class="label">Total Booking</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $pendingCount); ?></div><div class="label">Menunggu Konfirmasi</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $confirmedCount); ?></div><div class="label">Terkonfirmasi</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $completedCount); ?></div><div class="label">Selesai</div></div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Pemesanan Terbaru Saya</h2>
        <a href="<?php echo e(route('user.booking.create')); ?>" class="btn btn-primary btn-sm">+ Booking Baru</a>
    </div>

    <?php if($recent->isEmpty()): ?>
        <div class="empty-state">Anda belum memiliki pemesanan. <a href="<?php echo e(route('user.booking.create')); ?>">Buat booking pertama Anda!</a></div>
    <?php else: ?>
    <table>
        <thead><tr><th>Layanan</th><th>Tanggal &amp; Jam</th><th>Harga</th><th>Status</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($b->service->name); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y')); ?> &bull; <?php echo e(substr($b->booking_time, 0, 5)); ?></td>
                <td>Rp <?php echo e(number_format($b->service->price, 0, ',', '.')); ?></td>
                <td><?php echo $__env->make('partials.status-badge', ['status' => $b->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe)): ?>
<?php $attributes = $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe; ?>
<?php unset($__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe)): ?>
<?php $component = $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe; ?>
<?php unset($__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/user/dashboard.blade.php ENDPATH**/ ?>