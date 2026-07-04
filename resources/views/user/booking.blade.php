<x-dash-layout title="Booking Baru" active="booking" role="user">

<div class="panel" style="max-width:700px;">
    <div class="panel-head"><h2>Form Booking Sesi Foto</h2></div>

    @if ($services->isEmpty())
        <div class="empty-state">Belum ada layanan yang tersedia saat ini.</div>
    @else
    <form method="POST" action="{{ route('user.booking.store') }}" id="bookingForm">
        @csrf
        <div class="form-group">
            <label>Pilih Paket Layanan</label>
            <select name="service_id" id="serviceSelect" required>
                <option value="">-- Pilih Paket --</option>
                @foreach ($services as $s)
                    <option value="{{ $s->id }}"
                        data-tiers='@json(array_values($s->tiers()))'
                        {{ $selectedService === $s->id ? 'selected' : '' }}>
                        {{ $s->name }} ({{ (int) $s->duration_minutes }} menit)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Pilih Sub-Paket</label>
            <select name="tier" id="tierSelect" required>
                <option value="">-- Pilih layanan dulu --</option>
            </select>
            <div id="tierPriceHint" style="margin-top:8px; font-size:13px; color:#666;"></div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Booking</label>
                <input type="date" name="booking_date" id="bookingDate" min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required>
            </div>
            <div class="form-group">
                <label>Jam Booking</label>
                <input type="time" name="booking_time" id="bookingTime" value="{{ old('booking_time') }}" required>
            </div>
        </div>

        <div id="availabilityHint" style="margin-bottom:16px; font-size:13px;"></div>

        <div class="form-group">
            <label>Catatan Tambahan (opsional)</label>
            <textarea name="notes" rows="4" placeholder="Contoh: konsep foto, jumlah orang, referensi gaya, dll.">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block" id="submitBookingBtn">Kirim Permintaan Booking</button>
    </form>
    @endif
</div>

<script>
(function () {
    var serviceSelect = document.getElementById('serviceSelect');
    var tierSelect = document.getElementById('tierSelect');
    var priceHint = document.getElementById('tierPriceHint');
    var dateInput = document.getElementById('bookingDate');
    var timeInput = document.getElementById('bookingTime');
    var availabilityHint = document.getElementById('availabilityHint');
    var submitBtn = document.getElementById('submitBookingBtn');
    var preselectTier = @json($selectedTier ?: '');
    var checkUrl = @json(route('user.booking.check-availability'));
    var isAvailable = true;

    function formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function populateTiers() {
        var opt = serviceSelect.options[serviceSelect.selectedIndex];
        tierSelect.innerHTML = '';
        priceHint.textContent = '';

        if (!opt || !opt.value) {
            tierSelect.innerHTML = '<option value="">-- Pilih layanan dulu --</option>';
            return;
        }

        var tiers = JSON.parse(opt.getAttribute('data-tiers') || '[]');
        var placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = '-- Pilih Sub-Paket --';
        tierSelect.appendChild(placeholder);

        tiers.forEach(function (t) {
            var o = document.createElement('option');
            o.value = t.key;
            o.textContent = t.label + (t.price !== null ? ' — ' + formatRupiah(t.price) : ' — Sesuai Keikhlasan');
            o.setAttribute('data-price', t.price === null ? '' : t.price);
            o.setAttribute('data-desc', t.description);
            if (preselectTier && t.key === preselectTier) {
                o.selected = true;
            }
            tierSelect.appendChild(o);
        });

        updateHint();
    }

    function updateHint() {
        var opt = tierSelect.options[tierSelect.selectedIndex];
        if (opt && opt.value) {
            priceHint.textContent = opt.getAttribute('data-desc') || '';
        } else {
            priceHint.textContent = '';
        }
    }

    function checkAvailability() {
        availabilityHint.textContent = '';
        availabilityHint.style.color = '';
        isAvailable = true;
        submitBtn.disabled = false;

        if (!serviceSelect.value || !dateInput.value || !timeInput.value) {
            return;
        }

        availabilityHint.textContent = 'Mengecek ketersediaan jadwal...';
        availabilityHint.style.color = '#888';

        var params = new URLSearchParams({
            service_id: serviceSelect.value,
            booking_date: dateInput.value,
            booking_time: timeInput.value
        });

        fetch(checkUrl + '?' + params.toString(), {
            headers: { 'Accept': 'application/json' }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.available) {
                availabilityHint.textContent = '✓ Jadwal tersedia.';
                availabilityHint.style.color = '#1a7d3a';
                isAvailable = true;
                submitBtn.disabled = false;
            } else {
                availabilityHint.textContent = '✗ Jadwal ini sudah terisi booking lain. Silakan pilih tanggal/jam lain.';
                availabilityHint.style.color = '#c0392b';
                isAvailable = false;
                submitBtn.disabled = true;
            }
        })
        .catch(function () {
            // Kalau gagal cek (misal offline), biarkan tetap bisa submit,
            // validasi final tetap dilakukan di server.
            availabilityHint.textContent = '';
        });
    }

    serviceSelect.addEventListener('change', function () { populateTiers(); checkAvailability(); });
    tierSelect.addEventListener('change', updateHint);
    dateInput.addEventListener('change', checkAvailability);
    timeInput.addEventListener('change', checkAvailability);

    if (serviceSelect.value) {
        populateTiers();
    }
    checkAvailability();
})();
</script>

</x-dash-layout>
