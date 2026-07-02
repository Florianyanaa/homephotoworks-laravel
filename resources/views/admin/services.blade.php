<x-dash-layout title="Kelola Layanan" active="services" role="admin">

<div class="panel">
    <div class="panel-head">
        <h2>{{ $editData ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h2>
        @if ($editData)
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline btn-sm">Batal Edit</a>
        @endif
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error">{{ $error }}</div>
        @endforeach
    @endif

    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $editData->id ?? 0 }}">
        <div class="form-row">
            <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" name="name" value="{{ old('name', $editData->name ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Durasi (menit)</label>
                <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $editData->duration_minutes ?? '') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="3">{{ old('description', $editData->description ?? '') }}</textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" step="1000" name="price" value="{{ old('price', $editData->price ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div style="padding-top:12px;">
                    <label style="text-transform:none; letter-spacing:0; font-size:14px;">
                        <input type="checkbox" name="is_active" style="width:auto;" {{ (!$editData || $editData->is_active) ? 'checked' : '' }}>
                        Aktifkan layanan ini
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Foto Paket {{ $editData ? '(kosongkan jika tidak ingin mengganti)' : '(opsional)' }}</label>
            @if ($editData && $editData->image)
                @php $currentImgPath = public_path('uploads/services/' . $editData->image); @endphp
                @if (file_exists($currentImgPath))
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('uploads/services/' . $editData->image) }}" alt="{{ $editData->name }}" style="width:100px;height:100px;object-fit:cover;border-radius:6px;">
                </div>
                @endif
            @endif
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
        </div>
        <button type="submit" class="btn btn-primary">{{ $editData ? 'Simpan Perubahan' : 'Tambah Layanan' }}</button>
    </form>
</div>

<div class="panel">
    <div class="panel-head"><h2>Daftar Layanan</h2></div>
    @if ($services->isEmpty())
        <div class="empty-state">Belum ada layanan.</div>
    @else
    <table>
        <thead>
            <tr><th>Foto</th><th>Nama</th><th>Harga</th><th>Durasi</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($services as $s)
            @php $svcImgPath = $s->image ? public_path('uploads/services/' . $s->image) : null; @endphp
            <tr>
                <td>
                    <img src="{{ $svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $s->image) : asset('img/placeholder-service.jpg') }}" alt="{{ $s->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
                </td>
                <td>{{ $s->name }}</td>
                <td>Rp {{ number_format($s->price, 0, ',', '.') }}</td>
                <td>{{ (int) $s->duration_minutes }} menit</td>
                <td>{!! $s->is_active ? '<span class="badge badge-confirmed">Aktif</span>' : '<span class="badge badge-cancelled">Nonaktif</span>' !!}</td>
                <td class="action-icons">
                    <a href="{{ route('admin.services.index', ['edit' => $s->id]) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.services.destroy', $s->id) }}" onsubmit="return confirm('Hapus layanan ini?');" style="display:inline;">
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
