<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard'));
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email dan password wajib diisi.',
            'password.required' => 'Email dan password wajib diisi.',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();
        session()->flash('flash', ['type' => 'success', 'message' => "Selamat datang kembali, {$user->full_name}!"]);

        return redirect($user->isAdmin() ? route('admin.dashboard') : route('user.dashboard'));
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard'));
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirm' => ['required', 'same:password'],
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain atau masuk.',
            'password.min' => 'Password minimal 6 karakter.',
            'password_confirm.same' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        session()->flash('flash', ['type' => 'success', 'message' => "Akun berhasil dibuat! Selamat datang, {$user->full_name}."]);

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('flash', ['type' => 'info', 'message' => 'Anda telah berhasil keluar.']);

        return redirect()->route('login');
    }
}
