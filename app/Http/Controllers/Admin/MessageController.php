<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->get();

        return view('admin.messages', compact('messages'));
    }

    public function markRead(int $id)
    {
        ContactMessage::where('id', $id)->update(['is_read' => true]);

        return redirect()->route('admin.messages.index');
    }

    public function destroy(int $id)
    {
        ContactMessage::where('id', $id)->delete();

        session()->flash('flash', ['type' => 'success', 'message' => 'Pesan berhasil dihapus.']);

        return redirect()->route('admin.messages.index');
    }
}
