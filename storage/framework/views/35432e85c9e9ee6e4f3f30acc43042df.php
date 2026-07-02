<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Kelola Layanan','active' => 'services','role' => 'admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Layanan','active' => 'services','role' => 'admin']); ?>

<div class="panel">
    <div class="panel-head">
        <h2><?php echo e($editData ? 'Edit Layanan' : 'Tambah Layanan Baru'); ?></h2>
        <?php if($editData): ?>
            <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-outline btn-sm">Batal Edit</a>
        <?php endif; ?>
    </div>

    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-error"><?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.services.store')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($editData->id ?? 0); ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" name="name" value="<?php echo e(old('name', $editData->name ?? '')); ?>" required>
            </div>
            <div class="form-group">
                <label>Durasi (menit)</label>
                <input type="number" name="duration_minutes" value="<?php echo e(old('duration_minutes', $editData->duration_minutes ?? '')); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="3"><?php echo e(old('description', $editData->description ?? '')); ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" step="1000" name="price" value="<?php echo e(old('price', $editData->price ?? '')); ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div style="padding-top:12px;">
                    <label style="text-transform:none; letter-spacing:0; font-size:14px;">
                        <input type="checkbox" name="is_active" style="width:auto;" <?php echo e((!$editData || $editData->is_active) ? 'checked' : ''); ?>>
                        Aktifkan layanan ini
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo e($editData ? 'Simpan Perubahan' : 'Tambah Layanan'); ?></button>
    </form>
</div>

<div class="panel">
    <div class="panel-head"><h2>Daftar Layanan</h2></div>
    <?php if($services->isEmpty()): ?>
        <div class="empty-state">Belum ada layanan.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>Nama</th><th>Harga</th><th>Durasi</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($s->name); ?></td>
                <td>Rp <?php echo e(number_format($s->price, 0, ',', '.')); ?></td>
                <td><?php echo e((int) $s->duration_minutes); ?> menit</td>
                <td><?php echo $s->is_active ? '<span class="badge badge-confirmed">Aktif</span>' : '<span class="badge badge-cancelled">Nonaktif</span>'; ?></td>
                <td class="action-icons">
                    <a href="<?php echo e(route('admin.services.index', ['edit' => $s->id])); ?>">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.services.destroy', $s->id)); ?>" onsubmit="return confirm('Hapus layanan ini?');" style="display:inline;">
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/services.blade.php ENDPATH**/ ?>