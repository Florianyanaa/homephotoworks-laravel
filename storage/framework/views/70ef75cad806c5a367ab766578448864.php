<?php if (isset($component)) { $__componentOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c9cc46f3da5dd72525e3d80f5cb1ebe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dash-layout','data' => ['title' => 'Kelola Galeri','active' => 'gallery','role' => 'admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Galeri','active' => 'gallery','role' => 'admin']); ?>

<div class="panel">
    <div class="panel-head"><h2>Tambah Foto ke Galeri</h2></div>

    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-error"><?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.gallery.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-row">
            <div class="form-group">
                <label>Judul Foto</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" placeholder="Portrait, Prewedding, dll" value="Umum">
            </div>
        </div>
        <div class="form-group">
            <label>File Gambar</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" required>
        </div>
        <button type="submit" class="btn btn-primary">Unggah Foto</button>
    </form>
</div>

<div class="panel">
    <div class="panel-head"><h2>Semua Foto di Galeri (<?php echo e($items->count()); ?>)</h2></div>
    <?php if($items->isEmpty()): ?>
        <div class="empty-state">Belum ada foto di galeri.</div>
    <?php else: ?>
    <table>
        <thead><tr><th>Preview</th><th>Judul</th><th>Kategori</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $uploadedPath = public_path('uploads/gallery/' . $g->image); ?>
            <tr>
                <td>
                    <img src="<?php echo e(file_exists($uploadedPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg')); ?>" alt="<?php echo e($g->title); ?>" style="width:70px;height:70px;object-fit:cover;border-radius:4px;">
                </td>
                <td><?php echo e($g->title); ?></td>
                <td><?php echo e($g->category); ?></td>
                <td class="action-icons">
                    <form method="POST" action="<?php echo e(route('admin.gallery.destroy', $g->id)); ?>" onsubmit="return confirm('Hapus foto ini dari galeri?');" style="display:inline;">
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
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/admin/gallery.blade.php ENDPATH**/ ?>