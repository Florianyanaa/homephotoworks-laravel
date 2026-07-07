<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
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

    public function calendarData(Request $request)
    {
        $data = $request->validate([
            'year' => ['required', 'integer', 'min:2020', 'max:2100'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],
        ]);

        $start = Carbon::create($data['year'], $data['month'], 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $counts = Booking::whereBetween('booking_date', [$start->toDateString(), $end->toDateString()])
            ->whereIn('status', ['pending', 'confirmed'])
            ->selectRaw('booking_date, count(*) as total')
            ->groupBy('booking_date')
            ->pluck('total', 'booking_date');

        // Format key tanggal konsisten Y-m-d (kadang driver DB mengembalikan objek/format beda)
        $formatted = [];
        foreach ($counts as $date => $total) {
            $key = Carbon::parse($date)->format('Y-m-d');
            $formatted[$key] = (int) $total;
        }

        return response()->json(['counts' => $formatted]);
    }

    public function checkAvailability(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'booking_date' => ['required', 'date'],
            'booking_time' => ['required'],
        ]);

        $service = Service::find($data['service_id']);
        $newStart = Carbon::parse($data['booking_date'].' '.$data['booking_time']);
        $newEnd = $newStart->copy()->addMinutes((int) $service->duration_minutes);

        $hasConflict = Booking::with('service')
            ->where('booking_date', $data['booking_date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->get()
            ->contains(function ($existing) use ($newStart, $newEnd) {
                $existingStart = Carbon::parse($existing->booking_date->format('Y-m-d').' '.$existing->booking_time);
                $existingEnd = $existingStart->copy()->addMinutes((int) ($existing->service->duration_minutes ?? 60));

                return $newStart < $existingEnd && $existingStart < $newEnd;
            });

        return response()->json(['available' => ! $hasConflict]);
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

        $newStart = Carbon::parse($data['booking_date'].' '.$data['booking_time']);
        $newEnd = $newStart->copy()->addMinutes((int) $service->duration_minutes);

        $hasConflict = Booking::with('service')
            ->where('booking_date', $data['booking_date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->get()
            ->contains(function ($existing) use ($newStart, $newEnd) {
                $existingStart = Carbon::parse($existing->booking_date->format('Y-m-d').' '.$existing->booking_time);
                $existingEnd = $existingStart->copy()->addMinutes((int) ($existing->service->duration_minutes ?? 60));

                // Bentrok kalau kedua rentang waktu saling tumpang tindih
                return $newStart < $existingEnd && $existingStart < $newEnd;
            });

        if ($hasConflict) {
            return back()
                ->withInput()
                ->withErrors(['booking_time' => 'Jadwal ini bentrok dengan booking lain yang sudah ada. Silakan pilih tanggal atau jam yang berbeda.']);
        }

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
