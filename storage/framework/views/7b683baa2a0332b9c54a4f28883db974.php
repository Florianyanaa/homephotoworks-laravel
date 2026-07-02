<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Dashboard Admin','active' => 'dashboard','role' => 'admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Admin','active' => 'dashboard','role' => 'admin']); ?>

<div class="cards-row">
    <div class="stat-card"><div class="num"><?php echo e((int) $totalUsers); ?></div><div class="label">Total Pengguna</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $totalServices); ?></div><div class="label">Paket Layanan</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $totalBookings); ?></div><div class="label">Total Pemesanan</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $pendingBookings); ?></div><div class="label">Menunggu Konfirmasi</div></div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Pemesanan Terbaru</h2>
        <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-outline btn-sm">Lihat Semua</a>
    </div>

    <?php if($recentBookings->isEmpty()): ?>
        <div class="empty-state">Belum ada pemesanan masuk.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>Pelanggan</th><th>Layanan</th><th>Tanggal</th><th>Jam</th><th>Status</th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($b->user->full_name); ?></td>
                <td><?php echo e($b->service->name); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y')); ?></td>
                <td><?php echo e(substr($b->booking_time, 0, 5)); ?></td>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>