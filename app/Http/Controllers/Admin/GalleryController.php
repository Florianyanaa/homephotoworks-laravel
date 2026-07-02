<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::orderByDesc('id')->get();

        return view('admin.gallery', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'title.required' => 'Judul wajib diisi.',
            'image.required' => 'Silakan pilih gambar untuk diunggah.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        $uploadDir = public_path('uploads/gallery');
        if (! File::isDirectory($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        $ext = $request->file('image')->getClientOriginalExtension();
        $fileName = 'gal_'.time().'_'.random_int(1000, 9999).'.'.$ext;
        $request->file('image')->move($uploadDir, $fileName);

        Gallery::create([
            'title' => $data['title'],
            'category' => $data['category'] ?: 'Umum',
            'image' => $fileName,
        ]);

        session()->flash('flash', ['type' => 'success', 'message' => 'Foto berhasil ditambahkan ke galeri.']);

        return redirect()->route('admin.gallery.index');
    }

    public function destroy(int $id)
    {
        $item = Gallery::find($id);
        if ($item) {
            $path = public_path('uploads/gallery/'.$item->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $item->delete();
        }

        session()->flash('flash', ['type' => 'success', 'message' => 'Foto berhasil dihapus dari galeri.']);

        return redirect()->route('admin.gallery.index');
    }
}
