<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $editData = null;
        if ($request->filled('edit')) {
            $editData = Service::find((int) $request->query('edit'));
        }

        $services = Service::orderByDesc('id')->get();

        return view('admin.services', compact('services', 'editData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
            'duration_minutes' => ['required', 'integer', 'gt:0'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'name.required' => 'Nama, harga, dan durasi wajib diisi dengan benar.',
            'price.gt' => 'Nama, harga, dan durasi wajib diisi dengan benar.',
            'duration_minutes.gt' => 'Nama, harga, dan durasi wajib diisi dengan benar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        $payload = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'duration_minutes' => $data['duration_minutes'],
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            $uploadDir = public_path('uploads/services');
            if (! File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }

            // Hapus foto lama kalau sedang edit dan upload foto baru
            if (! empty($data['id'])) {
                $existing = Service::find($data['id']);
                if ($existing && $existing->image) {
                    $oldPath = public_path('uploads/services/'.$existing->image);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }
            }

            $ext = $request->file('image')->getClientOriginalExtension();
            $tempName = 'tmp_'.time().'_'.random_int(1000, 9999).'.'.$ext;
            $request->file('image')->move($uploadDir, $tempName);

            $webpName = 'svc_'.time().'_'.random_int(1000, 9999).'.webp';
            $converted = \App\Services\ImageOptimizer::toWebp($uploadDir.'/'.$tempName, $uploadDir.'/'.$webpName, 1200, 85);

            if ($converted) {
                @unlink($uploadDir.'/'.$tempName);
                $payload['image'] = $webpName;
            } else {
                // Fallback: server tidak support WebP, pakai file asli saja
                $payload['image'] = $tempName;
            }
        }

        if (! empty($data['id'])) {
            Service::where('id', $data['id'])->update($payload);
            session()->flash('flash', ['type' => 'success', 'message' => 'Layanan berhasil diperbarui.']);
        } else {
            Service::create($payload);
            session()->flash('flash', ['type' => 'success', 'message' => 'Layanan baru berhasil ditambahkan.']);
        }

        return redirect()->route('admin.services.index');
    }

    public function destroy(int $id)
    {
        $service = Service::find($id);
        if ($service && $service->image) {
            $path = public_path('uploads/services/'.$service->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        Service::where('id', $id)->delete();

        session()->flash('flash', ['type' => 'success', 'message' => 'Layanan berhasil dihapus.']);

        return redirect()->route('admin.services.index');
    }
}
