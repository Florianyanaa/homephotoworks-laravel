<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
        ], [
            'full_name.required' => 'Nama tidak boleh kosong.',
        ]);

        $request->user()->update($data);

        session()->flash('flash', ['type' => 'success', 'message' => 'Profil berhasil diperbarui.']);

        return redirect()->route('user.profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:new_password'],
        ], [
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'confirm_password.same' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (! Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $request->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        session()->flash('flash', ['type' => 'success', 'message' => 'Password berhasil diubah.']);

        return redirect()->route('user.profile');
    }
}
