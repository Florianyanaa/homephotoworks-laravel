<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $totalBookings = $request->user()->bookings()->count();
        $pendingCount = $request->user()->bookings()->where('status', 'pending')->count();
        $confirmedCount = $request->user()->bookings()->where('status', 'confirmed')->count();
        $completedCount = $request->user()->bookings()->where('status', 'completed')->count();

        $recent = $request->user()->bookings()
            ->with('service')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact(
            'totalBookings', 'pendingCount', 'confirmedCount', 'completedCount', 'recent'
        ));
    }
}
