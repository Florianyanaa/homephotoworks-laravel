<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        $selectedService = (int) $request->query('service_id', 0);
        $selectedTier = (string) $request->query('tier', '');

        return view('user.booking', compact('services', 'selectedService', 'selectedTier'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'tier' => ['required', 'in:seikhlasnya,small,medium,large'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required'],
            'notes' => ['nullable', 'string'],
        ], [
            'service_id.required' => 'Silakan lengkapi layanan, tanggal, dan jam booking.',
            'tier.required' => 'Silakan pilih sub-paket terlebih dahulu.',
            'tier.in' => 'Sub-paket yang dipilih tidak valid.',
            'booking_date.required' => 'Silakan lengkapi layanan, tanggal, dan jam booking.',
            'booking_date.after_or_equal' => 'Tanggal booking tidak boleh di masa lalu.',
            'booking_time.required' => 'Silakan lengkapi layanan, tanggal, dan jam booking.',
        ]);

        $service = Service::findOrFail($data['service_id']);
        $tier = $service->tiers()[$data['tier']];

        $request->user()->bookings()->create([
            'service_id' => $data['service_id'],
            'tier_key' => $tier['key'],
            'tier_label' => $tier['label'],
            'tier_price' => $tier['price'],
            'booking_date' => $data['booking_date'],
            'booking_time' => $data['booking_time'],
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
        ]);

        session()->flash('flash', ['type' => 'success', 'message' => 'Booking berhasil dikirim! Tim kami akan segera mengonfirmasi jadwal Anda.']);

        return redirect()->route('user.my-bookings');
    }
}
