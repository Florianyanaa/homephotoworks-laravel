<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Kelola Pengguna','active' => 'users','role' => 'admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Pengguna','active' => 'users','role' => 'admin']); ?>

<div class="panel">
    <div class="panel-head"><h2>Semua Pengguna (<?php echo e($users->count()); ?>)</h2></div>
    <table>
        <thead><tr><th>Nama</th><th>Email</th><th>Telepon</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($u->full_name); ?><?php if($u->id === auth()->id()): ?> <span style="color:#8a8a8a;font-size:12px;">(Anda)</span><?php endif; ?></td>
                <td><?php echo e($u->email); ?></td>
                <td><?php echo e($u->phone ?: '-'); ?></td>
                <td>
                    <form method="POST" action="<?php echo e(route('admin.users.role')); ?>" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?php echo e($u->id); ?>">
                        <select name="role" onchange="this.form.submit()" style="padding:6px 10px; border-radius:20px; font-size:12px; border:1px solid #d9d9d9;" <?php echo e($u->id === auth()->id() ? 'disabled' : ''); ?>>
                            <option value="user" <?php echo e($u->role==='user'?'selected':''); ?>>Pengguna</option>
                            <option value="admin" <?php echo e($u->role==='admin'?'selected':''); ?>>Admin</option>
                        </select>
                    </form>
                </td>
                <td><?php echo e(\Carbon\Carbon::parse($u->created_at)->translatedFormat('d F Y')); ?></td>
                <td class="action-icons">
                    <?php if($u->id !== auth()->id()): ?>
                        <form method="POST" action="<?php echo e(route('admin.users.destroy', $u->id)); ?>" onsubmit="return confirm('Hapus pengguna ini beserta seluruh datanya?');" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="danger" style="background:none;border:none;cursor:pointer;padding:0;">Hapus</button>
                        </form>
                    <?php else: ?>
                        <span style="color:#d9d9d9;">—</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/users.blade.php ENDPATH**/ ?>