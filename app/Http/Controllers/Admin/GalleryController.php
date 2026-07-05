<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $editData = null;
        if ($request->filled('edit')) {
            $editData = Gallery::find((int) $request->query('edit'));
        }

        $items = Gallery::orderByDesc('id')->get();

        return view('admin.gallery', compact('items', 'editData'));
    }

    public function store(Request $request)
    {
        $isEdit = $request->filled('id');

        $data = $request->validate([
            'id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => [$isEdit ? 'nullable' : 'required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'title.required' => 'Judul wajib diisi.',
            'image.required' => 'Silakan pilih gambar untuk diunggah.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        $payload = [
            'title' => $data['title'],
            'category' => $data['category'] ?: 'Umum',
            'description' => $data['description'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $uploadDir = public_path('uploads/gallery');
            if (! File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }

            // Hapus foto lama kalau sedang edit dan upload foto baru
            if ($isEdit) {
                $existing = Gallery::find($data['id']);
                if ($existing && $existing->image) {
                    $oldPath = public_path('uploads/gallery/'.$existing->image);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }
            }

            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName = 'gal_'.time().'_'.random_int(1000, 9999).'.'.$ext;
            $request->file('image')->move($uploadDir, $fileName);
            \App\Services\ImageOptimizer::optimize($uploadDir.'/'.$fileName, 1600, 80);

            $payload['image'] = $fileName;
        }

        if ($isEdit) {
            Gallery::where('id', $data['id'])->update($payload);
            session()->flash('flash', ['type' => 'success', 'message' => 'Foto galeri berhasil diperbarui.']);
        } else {
            Gallery::create($payload);
            session()->flash('flash', ['type' => 'success', 'message' => 'Foto berhasil ditambahkan ke galeri.']);
        }

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
