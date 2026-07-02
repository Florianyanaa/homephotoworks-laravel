<x-dash-layout title="Dashboard Admin" active="dashboard" role="admin">

<div class="cards-row">
    <div class="stat-card"><div class="num">{{ (int) $totalUsers }}</div><div class="label">Total Pengguna</div></div>
    <div class="stat-card"><div class="num">{{ (int) $totalServices }}</div><div class="label">Paket Layanan</div></div>
    <div class="stat-card"><div class="num">{{ (int) $totalBookings }}</div><div class="label">Total Pemesanan</div></div>
    <div class="stat-card"><div class="num">{{ (int) $pendingBookings }}</div><div class="label">Menunggu Konfirmasi</div></div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Pemesanan Terbaru</h2>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
    </div>

    @if ($recentBookings->isEmpty())
        <div class="empty-state">Belum ada pemesanan masuk.</div>
    @else
    <table>
        <thead>
            <tr><th>Pelanggan</th><th>Layanan</th><th>Tanggal</th><th>Jam</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach ($recentBookings as $b)
            <tr>
                <td>{{ $b->user->full_name }}</td>
                <td>{{ $b->service->name }}</td>
                <td>{{ \Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y') }}</td>
                <td>{{ substr($b->booking_time, 0, 5) }}</td>
                <td>@include('partials.status-badge', ['status' => $b->status])</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

</x-dash-layout>
