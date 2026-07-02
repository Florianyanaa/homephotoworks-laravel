<x-dash-layout title="Booking Baru" active="booking" role="user">

<div class="panel" style="max-width:700px;">
    <div class="panel-head"><h2>Form Booking Sesi Foto</h2></div>

    @if ($services->isEmpty())
        <div class="empty-state">Belum ada layanan yang tersedia saat ini.</div>
    @else
    <form method="POST" action="{{ route('user.booking.store') }}">
        @csrf
        <div class="form-group">
            <label>Pilih Paket Layanan</label>
            <select name="service_id" required>
                <option value="">-- Pilih Paket --</option>
                @foreach ($services as $s)
                    <option value="{{ $s->id }}" {{ $selectedService === $s->id ? 'selected' : '' }}>
                        {{ $s->name }} — Rp {{ number_format($s->price, 0, ',', '.') }} ({{ (int) $s->duration_minutes }} menit)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Booking</label>
                <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required>
            </div>
            <div class="form-group">
                <label>Jam Booking</label>
                <input type="time" name="booking_time" value="{{ old('booking_time') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Catatan Tambahan (opsional)</label>
            <textarea name="notes" rows="4" placeholder="Contoh: konsep foto, jumlah orang, referensi gaya, dll.">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Kirim Permintaan Booking</button>
    </form>
    @endif
</div>

</x-dash-layout>
