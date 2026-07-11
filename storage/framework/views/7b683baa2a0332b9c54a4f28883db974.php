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
    <div class="stat-card"><div class="num"><?php echo e((int) $totalServices); ?></div><div class="label">Paket Layanan</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $totalGallery); ?></div><div class="label">Foto Galeri</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $totalMessages); ?></div><div class="label">Total Pertanyaan Masuk</div></div>
    <div class="stat-card"><div class="num"><?php echo e((int) $unreadMessages); ?></div><div class="label">Belum Dibaca</div></div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Pertanyaan Terbaru</h2>
        <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-outline btn-sm">Lihat Semua</a>
    </div>

    <?php if($recentMessages->isEmpty()): ?>
        <div class="empty-state">Belum ada pertanyaan masuk lewat form Kontak.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>Nama</th><th>Kontak</th><th>Pesan</th><th>Status</th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $recentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($m->name); ?></td>
                <td style="color:#8a8a8a; font-size:13px;"><?php echo e($m->email); ?><?php if($m->phone): ?><br><?php echo e($m->phone); ?><?php endif; ?></td>
                <td style="max-width:320px;"><?php echo e(\Illuminate\Support\Str::limit($m->message, 80)); ?></td>
                <td>
                    <?php if($m->is_read): ?>
                        <span class="badge badge-completed">Sudah Dibaca</span>
                    <?php else: ?>
                        <span class="badge badge-pending">Belum Dibaca</span>
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>