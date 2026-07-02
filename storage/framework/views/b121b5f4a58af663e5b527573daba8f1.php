<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Pemesanan Saya','active' => 'my_bookings','role' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pemesanan Saya','active' => 'my_bookings','role' => 'user']); ?>

<div class="panel">
    <div class="panel-head">
        <h2>Riwayat Pemesanan Saya</h2>
        <a href="<?php echo e(route('user.booking.create')); ?>" class="btn btn-primary btn-sm">+ Booking Baru</a>
    </div>

    <?php if($bookings->isEmpty()): ?>
        <div class="empty-state">Anda belum memiliki pemesanan. <a href="<?php echo e(route('user.booking.create')); ?>">Buat booking pertama Anda!</a></div>
    <?php else: ?>
    <table>
        <thead><tr><th>Layanan</th><th>Tanggal &amp; Jam</th><th>Harga</th><th>Catatan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($b->service->name); ?><?php if($b->tier_label): ?><br><span style="color:#8a8a8a;font-size:12px;"><?php echo e($b->tier_label); ?></span><?php endif; ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y')); ?><br><span style="color:#8a8a8a;font-size:12px;"><?php echo e(substr($b->booking_time, 0, 5)); ?> WIB</span></td>
                <td><?php echo e($b->tier_price !== null ? 'Rp ' . number_format($b->tier_price, 0, ',', '.') : 'Sesuai Keikhlasan'); ?></td>
                <td style="max-width:200px;"><?php echo e($b->notes ?: '-'); ?></td>
                <td><?php echo $__env->make('partials.status-badge', ['status' => $b->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                <td class="action-icons">
                    <?php if($b->status === 'pending'): ?>
                        <form method="POST" action="<?php echo e(route('user.my-bookings.cancel', $b->id)); ?>" onsubmit="return confirm('Batalkan pemesanan ini?');" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="danger" style="background:none;border:none;cursor:pointer;padding:0;">Batalkan</button>
                        </form>
                    <?php else: ?>
                        <span style="color:#d9d9d9;">—</span>
                    <?php endif; ?>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/user/my_bookings.blade.php ENDPATH**/ ?>