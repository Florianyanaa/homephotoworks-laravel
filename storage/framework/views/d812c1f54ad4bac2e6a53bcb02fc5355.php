<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Kelola Pemesanan','active' => 'bookings','role' => 'admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Pemesanan','active' => 'bookings','role' => 'admin']); ?>

<div class="panel">
    <div class="panel-head">
        <h2>Semua Pemesanan</h2>
        <form method="get" style="display:flex; gap:8px;">
            <select name="status" onchange="this.form.submit()" style="padding:8px 12px; border-radius:4px; border:1px solid #d9d9d9;">
                <option value="">Semua Status</option>
                <option value="pending" <?php echo e($filter === 'pending' ? 'selected' : ''); ?>>Menunggu Konfirmasi</option>
                <option value="confirmed" <?php echo e($filter === 'confirmed' ? 'selected' : ''); ?>>Terkonfirmasi</option>
                <option value="completed" <?php echo e($filter === 'completed' ? 'selected' : ''); ?>>Selesai</option>
                <option value="cancelled" <?php echo e($filter === 'cancelled' ? 'selected' : ''); ?>>Dibatalkan</option>
            </select>
        </form>
    </div>

    <?php if($bookings->isEmpty()): ?>
        <div class="empty-state">Tidak ada data pemesanan.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Pelanggan</th><th>Layanan</th><th>Tanggal &amp; Jam</th><th>Harga</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <strong><?php echo e($b->user->full_name); ?></strong><br>
                    <span style="color:#8a8a8a; font-size:12px;"><?php echo e($b->user->email); ?></span>
                </td>
                <td><?php echo e($b->service->name); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y')); ?><br><span style="color:#8a8a8a; font-size:12px;"><?php echo e(substr($b->booking_time, 0, 5)); ?> WIB</span></td>
                <td>Rp <?php echo e(number_format($b->service->price, 0, ',', '.')); ?></td>
                <td>
                    <form method="POST" action="<?php echo e(route('admin.bookings.status')); ?>" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="booking_id" value="<?php echo e($b->id); ?>">
                        <select name="status" onchange="this.form.submit()" style="padding:6px 10px; border-radius:20px; font-size:12px; border:1px solid #d9d9d9;">
                            <option value="pending" <?php echo e($b->status==='pending'?'selected':''); ?>>Menunggu</option>
                            <option value="confirmed" <?php echo e($b->status==='confirmed'?'selected':''); ?>>Terkonfirmasi</option>
                            <option value="completed" <?php echo e($b->status==='completed'?'selected':''); ?>>Selesai</option>
                            <option value="cancelled" <?php echo e($b->status==='cancelled'?'selected':''); ?>>Dibatalkan</option>
                        </select>
                    </form>
                </td>
                <td class="action-icons">
                    <form method="POST" action="<?php echo e(route('admin.bookings.destroy', $b->id)); ?>" onsubmit="return confirm('Hapus pemesanan ini?');" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="danger" style="background:none;border:none;cursor:pointer;padding:0;">Hapus</button>
                    </form>
                </td>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/bookings.blade.php ENDPATH**/ ?>