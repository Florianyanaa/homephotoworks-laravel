<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyBookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = $request->user()->bookings()
            ->with('service')
            ->orderByDesc('booking_date')
            ->orderByDesc('booking_time')
            ->get();

        return view('user.my_bookings', compact('bookings'));
    }

    public function cancel(Request $request, int $id)
    {
        $request->user()->bookings()
            ->where('id', $id)
            ->where('status', 'pending')
            ->update(['status' => 'cancelled']);

        session()->flash('flash', ['type' => 'success', 'message' => 'Pemesanan berhasil dibatalkan.']);

        return redirect()->route('user.my-bookings');
    }
}
