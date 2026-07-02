<x-dash-layout title="Kelola Galeri" active="gallery" role="admin">

<div class="panel">
    <div class="panel-head"><h2>Tambah Foto ke Galeri</h2></div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error">{{ $error }}</div>
        @endforeach
    @endif

    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label>Judul Foto</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" placeholder="Portrait, Prewedding, dll" value="Umum">
            </div>
        </div>
        <div class="form-group">
            <label>File Gambar</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" required>
        </div>
        <button type="submit" class="btn btn-primary">Unggah Foto</button>
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
