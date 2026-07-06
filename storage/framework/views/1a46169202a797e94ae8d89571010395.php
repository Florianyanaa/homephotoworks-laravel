<?php
$map = [
    'pending'   => ['Menunggu Konfirmasi', 'badge-pending'],
    'confirmed' => ['Terkonfirmasi', 'badge-confirmed'],
    'completed' => ['Selesai', 'badge-completed'],
    'cancelled' => ['Dibatalkan', 'badge-cancelled'],
];
[$label, $class] = $map[$status] ?? [$status, ''];
?>
<span class="badge <?php echo e($class); ?>"><?php echo e($label); ?></span>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/partials/status-badge.blade.php ENDPATH**/ ?>