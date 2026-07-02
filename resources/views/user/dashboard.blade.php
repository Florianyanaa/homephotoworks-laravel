<x-dash-layout title="Dashboard Saya" active="dashboard" role="user">

<div class="cards-row">
    <div class="stat-card"><div class="num">{{ (int) $totalBookings }}</div><div class="label">Total Booking</div></div>
    <div class="stat-card"><div class="num">{{ (int) $pendingCount }}</div><div class="label">Menunggu Konfirmasi</div></div>
    <div class="stat-card"><div class="num">{{ (int) $confirmedCount }}</div><div class="label">Terkonfirmasi</div></div>
    <div class="stat-card"><div class="num">{{ (int) $completedCount }}</div><div class="label">Selesai</div></div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Pemesanan Terbaru Saya</h2>
        <a href="{{ route('user.booking.create') }}" class="btn btn-primary btn-sm">+ Booking Baru</a>
    </div>

    @if ($recent->isEmpty())
        <div class="empty-state">Anda belum memiliki pemesanan. <a href="{{ route('user.booking.create') }}">Buat booking pertama Anda!</a></div>
    @else
    <table>
        <thead><tr><th>Layanan</th><th>Tanggal &amp; Jam</th><th>Harga</th><th>Status</th></tr></thead>
        <tbody>
            @foreach ($recent as $b)
            <tr>
                <td>{{ $b->service->name }}</td>
                <td>{{ \Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y') }} &bull; {{ substr($b->booking_time, 0, 5) }}</td>
                <td>Rp {{ number_format($b->service->price, 0, ',', '.') }}</td>
                <td>@include('partials.status-badge', ['status' => $b->status])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

</x-dash-layout>
