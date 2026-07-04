<x-dash-layout title="Pesan Masuk" active="messages" role="admin">

<div class="panel">
    <div class="panel-head"><h2>Semua Pesan dari Form Kontak ({{ $messages->count() }})</h2></div>

    @if ($messages->isEmpty())
        <div class="empty-state">Belum ada pesan masuk.</div>
    @else
    <table>
        <thead><tr><th>Status</th><th>Nama</th><th>Email</th><th>Pesan</th><th>Waktu</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($messages as $m)
            <tr style="{{ $m->is_read ? '' : 'background:#fafafa; font-weight:600;' }}">
                <td>
                    @if ($m->is_read)
                        <span class="badge badge-completed">Dibaca</span>
                    @else
                        <span class="badge badge-pending">Baru</span>
                    @endif
                </td>
                <td>{{ $m->name }}</td>
                <td>{{ $m->email }}</td>
                <td style="max-width:320px;">{{ $m->message }}</td>
                <td>{{ \Carbon\Carbon::parse($m->created_at)->translatedFormat('d M Y, H:i') }}</td>
                <td class="action-icons">
                    <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', '6285210400454') . '?text=' . rawurlencode("Halo {$m->name}, terima kasih sudah menghubungi Home Photoworks.") }}" target="_blank" rel="noopener">Balas WA</a>
                    @if (!$m->is_read)
                        <form method="POST" action="{{ route('admin.messages.read', $m->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:none;border:none;cursor:pointer;padding:0;color:var(--gray-dark);">Tandai Dibaca</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.messages.destroy', $m->id) }}" onsubmit="return confirm('Hapus pesan ini?');" style="display:inline;">
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
