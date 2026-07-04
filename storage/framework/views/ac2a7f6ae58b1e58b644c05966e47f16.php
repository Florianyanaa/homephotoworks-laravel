<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Pesan Masuk','active' => 'messages','role' => 'admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pesan Masuk','active' => 'messages','role' => 'admin']); ?>

<div class="panel">
    <div class="panel-head"><h2>Semua Pesan dari Form Kontak (<?php echo e($messages->count()); ?>)</h2></div>

    <?php if($messages->isEmpty()): ?>
        <div class="empty-state">Belum ada pesan masuk.</div>
    <?php else: ?>
    <table>
        <thead><tr><th>Status</th><th>Nama</th><th>Email</th><th>Pesan</th><th>Waktu</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr style="<?php echo e($m->is_read ? '' : 'background:#fafafa; font-weight:600;'); ?>">
                <td>
                    <?php if($m->is_read): ?>
                        <span class="badge badge-completed">Dibaca</span>
                    <?php else: ?>
                        <span class="badge badge-pending">Baru</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($m->name); ?></td>
                <td><?php echo e($m->email); ?></td>
                <td style="max-width:320px;"><?php echo e($m->message); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($m->created_at)->translatedFormat('d M Y, H:i')); ?></td>
                <td class="action-icons">
                    <a href="<?php echo e('https://wa.me/' . preg_replace('/[^0-9]/', '', '6285210400454') . '?text=' . rawurlencode("Halo {$m->name}, terima kasih sudah menghubungi Home Photoworks.")); ?>" target="_blank" rel="noopener">Balas WA</a>
                    <?php if(!$m->is_read): ?>
                        <form method="POST" action="<?php echo e(route('admin.messages.read', $m->id)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background:none;border:none;cursor:pointer;padding:0;color:var(--gray-dark);">Tandai Dibaca</button>
                        </form>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('admin.messages.destroy', $m->id)); ?>" onsubmit="return confirm('Hapus pesan ini?');" style="display:inline;">
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/messages.blade.php ENDPATH**/ ?>