<x-dash-layout title="Kelola Pemesanan" active="bookings" role="admin">

<div class="panel">
    <div class="panel-head">
        <h2>Semua Pemesanan</h2>
        <form method="get" style="display:flex; gap:8px;">
            <select name="status" onchange="this.form.submit()" style="padding:8px 12px; border-radius:4px; border:1px solid #d9d9d9;">
                <option value="">Semua Status</option>
                <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="confirmed" {{ $filter === 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                <option value="completed" {{ $filter === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ $filter === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </form>
    </div>

    @if ($bookings->isEmpty())
        <div class="empty-state">Tidak ada data pemesanan.</div>
    @else
    <table>
        <thead>
            <tr>
                <th>Pelanggan</th><th>Layanan</th><th>Tanggal &amp; Jam</th><th>Harga</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $b)
            <tr>
                <td>
                    <strong>{{ $b->user->full_name }}</strong><br>
                    <span style="color:#8a8a8a; font-size:12px;">{{ $b->user->email }}</span>
                </td>
                <td>{{ $b->service->name }}</td>
                <td>{{ \Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y') }}<br><span style="color:#8a8a8a; font-size:12px;">{{ substr($b->booking_time, 0, 5) }} WIB</span></td>
                <td>Rp {{ number_format($b->service->price, 0, ',', '.') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.bookings.status') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $b->id }}">
                        <select name="status" onchange="this.form.submit()" style="padding:6px 10px; border-radius:20px; font-size:12px; border:1px solid #d9d9d9;">
                            <option value="pending" {{ $b->status==='pending'?'selected':'' }}>Menunggu</option>
                            <option value="confirmed" {{ $b->status==='confirmed'?'selected':'' }}>Terkonfirmasi</option>
                            <option value="completed" {{ $b->status==='completed'?'selected':'' }}>Selesai</option>
                            <option value="cancelled" {{ $b->status==='cancelled'?'selected':'' }}>Dibatalkan</option>
                        </select>
                    </form>
                </td>
                <td class="action-icons">
                    <form method="POST" action="{{ route('admin.bookings.destroy', $b->id) }}" onsubmit="return confirm('Hapus pemesanan ini?');" style="display:inline;">
                        @csrf
                        <button type="submit" class="danger" style="background:none;border:none;cursor:pointer;padding:0;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

</x-dash-layout>
