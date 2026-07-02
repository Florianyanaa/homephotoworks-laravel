<x-dash-layout title="Pemesanan Saya" active="my_bookings" role="user">

<div class="panel">
    <div class="panel-head">
        <h2>Riwayat Pemesanan Saya</h2>
        <a href="{{ route('user.booking.create') }}" class="btn btn-primary btn-sm">+ Booking Baru</a>
    </div>

    @if ($bookings->isEmpty())
        <div class="empty-state">Anda belum memiliki pemesanan. <a href="{{ route('user.booking.create') }}">Buat booking pertama Anda!</a></div>
    @else
    <table>
        <thead><tr><th>Layanan</th><th>Tanggal &amp; Jam</th><th>Harga</th><th>Catatan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($bookings as $b)
            <tr>
                <td>{{ $b->service->name }}</td>
                <td>{{ \Carbon\Carbon::parse($b->booking_date)->translatedFormat('d F Y') }}<br><span style="color:#8a8a8a;font-size:12px;">{{ substr($b->booking_time, 0, 5) }} WIB</span></td>
                <td>Rp {{ number_format($b->service->price, 0, ',', '.') }}</td>
                <td style="max-width:200px;">{{ $b->notes ?: '-' }}</td>
                <td>@include('partials.status-badge', ['status' => $b->status])</td>
                <td class="action-icons">
                    @if ($b->status === 'pending')
                        <form method="POST" action="{{ route('user.my-bookings.cancel', $b->id) }}" onsubmit="return confirm('Batalkan pemesanan ini?');" style="display:inline;">
                            @csrf
                            <button type="submit" class="danger" style="background:none;border:none;cursor:pointer;padding:0;">Batalkan</button>
                        </form>
                    @else
                        <span style="color:#d9d9d9;">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

</x-dash-layout>
