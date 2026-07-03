<x-dash-layout title="Kelola Galeri" active="gallery" role="admin">

<div class="panel">
    <div class="panel-head">
        <h2>{{ $editData ? 'Edit Foto Galeri' : 'Tambah Foto ke Galeri' }}</h2>
        @if ($editData)
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline btn-sm">Batal Edit</a>
        @endif
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error">{{ $error }}</div>
        @endforeach
    @endif

    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $editData->id ?? '' }}">
        <div class="form-row">
            <div class="form-group">
                <label>Judul Foto</label>
                <input type="text" name="title" value="{{ old('title', $editData->title ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" placeholder="Portrait, Prewedding, dll" value="{{ old('category', $editData->category ?? 'Umum') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi (opsional, tampil di halaman detail foto)</label>
            <textarea name="description" rows="3" placeholder="Cerita singkat di balik foto ini...">{{ old('description', $editData->description ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>File Gambar {{ $editData ? '(kosongkan jika tidak ingin mengganti)' : '' }}</label>
            @if ($editData && $editData->image)
                @php $currentImgPath = public_path('uploads/gallery/' . $editData->image); @endphp
                @if (file_exists($currentImgPath))
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('uploads/gallery/' . $editData->image) }}" alt="{{ $editData->title }}" style="width:100px;height:100px;object-fit:cover;border-radius:6px;">
                </div>
                @endif
            @endif
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" {{ $editData ? '' : 'required' }}>
        </div>
        <button type="submit" class="btn btn-primary">{{ $editData ? 'Simpan Perubahan' : 'Unggah Foto' }}</button>
    </form>
</div>

<div class="panel">
    <div class="panel-head"><h2>Semua Foto di Galeri ({{ $items->count() }})</h2></div>
    @if ($items->isEmpty())
        <div class="empty-state">Belum ada foto di galeri.</div>
    @else
    <table>
        <thead><tr><th>Preview</th><th>Judul</th><th>Kategori</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($items as $g)
            @php $uploadedPath = public_path('uploads/gallery/' . $g->image); @endphp
            <tr>
                <td>
                    <img src="{{ file_exists($uploadedPath) ? asset('uploads/gallery/' . $g->image) : asset('img/placeholder-gallery.jpg') }}" alt="{{ $g->title }}" style="width:70px;height:70px;object-fit:cover;border-radius:4px;">
                </td>
                <td>{{ $g->title }}</td>
                <td>{{ $g->category }}</td>
                <td class="action-icons">
                    <a href="{{ route('admin.gallery.index', ['edit' => $g->id]) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $g->id) }}" onsubmit="return confirm('Hapus foto ini dari galeri?');" style="display:inline;">
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
