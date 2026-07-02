<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

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
        ], [
            'name.required' => 'Nama, harga, dan durasi wajib diisi dengan benar.',
            'price.gt' => 'Nama, harga, dan durasi wajib diisi dengan benar.',
            'duration_minutes.gt' => 'Nama, harga, dan durasi wajib diisi dengan benar.',
        ]);

        $payload = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'duration_minutes' => $data['duration_minutes'],
            'is_active' => $request->boolean('is_active'),
        ];

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
        Service::where('id', $id)->delete();

        session()->flash('flash', ['type' => 'success', 'message' => 'Layanan berhasil dihapus.']);

        return redirect()->route('admin.services.index');
    }
}
