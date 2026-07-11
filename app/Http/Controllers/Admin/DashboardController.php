<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'admin')->count();
        $totalServices = Service::count();
        $totalGallery = Gallery::count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentMessages = ContactMessage::orderByDesc('created_at')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalServices', 'totalGallery', 'totalMessages', 'unreadMessages', 'recentMessages'
        ));
    }
}
