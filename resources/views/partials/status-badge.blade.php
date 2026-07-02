@php
$map = [
    'pending'   => ['Menunggu Konfirmasi', 'badge-pending'],
    'confirmed' => ['Terkonfirmasi', 'badge-confirmed'],
    'completed' => ['Selesai', 'badge-completed'],
    'cancelled' => ['Dibatalkan', 'badge-cancelled'],
];
[$label, $class] = $map[$status] ?? [$status, ''];
@endphp
<span class="badge {{ $class }}">{{ $label }}</span>
