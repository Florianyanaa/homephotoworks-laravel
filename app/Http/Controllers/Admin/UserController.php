<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();

        return view('admin.users', compact('users'));
    }

    public function toggleRole(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'role' => ['required', 'in:admin,user'],
        ]);

        if ((int) $data['user_id'] === $request->user()->id) {
            session()->flash('flash', ['type' => 'error', 'message' => 'Anda tidak dapat mengubah role akun Anda sendiri.']);

            return redirect()->route('admin.users.index');
        }

        User::where('id', $data['user_id'])->update(['role' => $data['role']]);

        session()->flash('flash', ['type' => 'success', 'message' => 'Role pengguna berhasil diperbarui.']);

        return redirect()->route('admin.users.index');
    }

    public function destroy(Request $request, int $id)
    {
        if ($id === $request->user()->id) {
            session()->flash('flash', ['type' => 'error', 'message' => 'Anda tidak dapat menghapus akun Anda sendiri.']);

            return redirect()->route('admin.users.index');
        }

        User::where('id', $id)->delete();

        session()->flash('flash', ['type' => 'success', 'message' => 'Pengguna berhasil dihapus.']);

        return redirect()->route('admin.users.index');
    }
}
