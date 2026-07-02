<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Profil Saya','active' => 'profile','role' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Saya','active' => 'profile','role' => 'user']); ?>

<div class="panel" style="max-width:600px;">
    <div class="panel-head"><h2>Informasi Akun</h2></div>
    <form method="POST" action="<?php echo e(route('user.profile.update')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="full_name" value="<?php echo e(old('full_name', $user->full_name)); ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" value="<?php echo e($user->email); ?>" disabled style="background:#f5f4f2;">
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<div class="panel" style="max-width:600px;">
    <div class="panel-head"><h2>Ubah Password</h2></div>
    <form method="POST" action="<?php echo e(route('user.profile.password')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Password Saat Ini</label>
            <input type="password" name="current_password" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-outline">Ubah Password</button>
    </form>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/user/profile.blade.php ENDPATH**/ ?>