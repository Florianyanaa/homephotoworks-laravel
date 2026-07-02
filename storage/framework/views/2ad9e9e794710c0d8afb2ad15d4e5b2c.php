<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Booking Baru','active' => 'booking','role' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Booking Baru','active' => 'booking','role' => 'user']); ?>

<div class="panel" style="max-width:700px;">
    <div class="panel-head"><h2>Form Booking Sesi Foto</h2></div>

    <?php if($services->isEmpty()): ?>
        <div class="empty-state">Belum ada layanan yang tersedia saat ini.</div>
    <?php else: ?>
    <form method="POST" action="<?php echo e(route('user.booking.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Pilih Paket Layanan</label>
            <select name="service_id" required>
                <option value="">-- Pilih Paket --</option>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>" <?php echo e($selectedService === $s->id ? 'selected' : ''); ?>>
                        <?php echo e($s->name); ?> — Rp <?php echo e(number_format($s->price, 0, ',', '.')); ?> (<?php echo e((int) $s->duration_minutes); ?> menit)
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Booking</label>
                <input type="date" name="booking_date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('booking_date')); ?>" required>
            </div>
            <div class="form-group">
                <label>Jam Booking</label>
                <input type="time" name="booking_time" value="<?php echo e(old('booking_time')); ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Catatan Tambahan (opsional)</label>
            <textarea name="notes" rows="4" placeholder="Contoh: konsep foto, jumlah orang, referensi gaya, dll."><?php echo e(old('notes')); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Kirim Permintaan Booking</button>
    </form>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/user/booking.blade.php ENDPATH**/ ?>