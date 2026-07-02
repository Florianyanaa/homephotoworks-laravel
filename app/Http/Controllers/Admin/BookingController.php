<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('status', '');

        $query = Booking::with(['user', 'service']);
        if (in_array($filter, ['pending', 'confirmed', 'completed', 'cancelled'], true)) {
            $query->where('status', $filter);
        }

        $bookings = $query->orderByDesc('booking_date')->orderByDesc('booking_time')->get();

        return view('admin.bookings', compact('bookings', 'filter'));
    }

    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'integer', 'exists:bookings,id'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
        ]);

        Booking::where('id', $data['booking_id'])->update(['status' => $data['status']]);

        session()->flash('flash', ['type' => 'success', 'message' => 'Status pemesanan berhasil diperbarui.']);

        return redirect()->route('admin.bookings.index');
    }

    public function destroy(int $id)
    {
        Booking::where('id', $id)->delete();

        session()->flash('flash', ['type' => 'success', 'message' => 'Pemesanan berhasil dihapus.']);

        return redirect()->route('admin.bookings.index');
    }
}
