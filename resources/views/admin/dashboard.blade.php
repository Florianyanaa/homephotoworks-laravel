<x-dash-layout title="Dashboard Admin" active="dashboard" role="admin">

<div class="cards-row">
    <div class="stat-card"><div class="num">{{ (int) $totalServices }}</div><div class="label">Paket Layanan</div></div>
    <div class="stat-card"><div class="num">{{ (int) $totalGallery }}</div><div class="label">Foto Galeri</div></div>
    <div class="stat-card"><div class="num">{{ (int) $totalMessages }}</div><div class="label">Total Pertanyaan Masuk</div></div>
    <div class="stat-card"><div class="num">{{ (int) $unreadMessages }}</div><div class="label">Belum Dibaca</div></div>
</div>

<div class="panel">
    <div class="panel-head">
        <h2>Pertanyaan Terbaru</h2>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
    </div>

    @if ($recentMessages->isEmpty())
        <div class="empty-state">Belum ada pertanyaan masuk lewat form Kontak.</div>
    @else
    <table>
        <thead>
            <tr><th>Nama</th><th>Kontak</th><th>Pesan</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach ($recentMessages as $m)
            <tr>
                <td>{{ $m->name }}</td>
                <td style="color:#8a8a8a; font-size:13px;">{{ $m->email }}@if($m->phone)<br>{{ $m->phone }}@endif</td>
                <td style="max-width:320px;">{{ \Illuminate\Support\Str::limit($m->message, 80) }}</td>
                <td>
                    @if ($m->is_read)
                        <span class="badge badge-completed">Sudah Dibaca</span>
                    @else
                        <span class="badge badge-pending">Belum Dibaca</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

</x-dash-layout>
