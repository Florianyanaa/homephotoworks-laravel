<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'message.required' => 'Pesan tidak boleh kosong.',
        ]);

        ContactMessage::create($data);

        $waText = "Halo Home Photoworks, saya {$data['name']} ({$data['email']}, {$data['phone']}).\n\n{$data['message']}";
        $waLink = 'https://wa.me/6285210400454?text='.rawurlencode($waText);

        session()->flash('flash', ['type' => 'success', 'message' => 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda kembali.']);
        session()->flash('wa_link', $waLink);

        return redirect()->route('kontak');
    }
}
