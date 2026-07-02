<x-dash-layout title="Kelola Pengguna" active="users" role="admin">

<div class="panel">
    <div class="panel-head"><h2>Semua Pengguna ({{ $users->count() }})</h2></div>
    <table>
        <thead><tr><th>Nama</th><th>Email</th><th>Telepon</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($users as $u)
            <tr>
                <td>{{ $u->full_name }}@if($u->id === auth()->id()) <span style="color:#8a8a8a;font-size:12px;">(Anda)</span>@endif</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->phone ?: '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.role') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $u->id }}">
                        <select name="role" onchange="this.form.submit()" style="padding:6px 10px; border-radius:20px; font-size:12px; border:1px solid #d9d9d9;" {{ $u->id === auth()->id() ? 'disabled' : '' }}>
                            <option value="user" {{ $u->role==='user'?'selected':'' }}>Pengguna</option>
                            <option value="admin" {{ $u->role==='admin'?'selected':'' }}>Admin</option>
                        </select>
                    </form>
                </td>
                <td>{{ \Carbon\Carbon::parse($u->created_at)->translatedFormat('d F Y') }}</td>
                <td class="action-icons">
                    @if ($u->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}" onsubmit="return confirm('Hapus pengguna ini beserta seluruh datanya?');" style="display:inline;">
                            @csrf
                            <button type="submit" class="danger" style="background:none;border:none;cursor:pointer;padding:0;">Hapus</button>
                        </form>
                    @else
                        <span style="color:#d9d9d9;">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-dash-layout>
