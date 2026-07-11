<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Booking Sesi Foto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Booking Sesi Foto']); ?>

<section class="page-hero">
    <div class="container page-hero-content">
        <span class="eyebrow">Booking Online</span>
        <h1>Booking Sesi Foto Anda</h1>
        <p>Isi form di bawah ini, tim kami akan menghubungi Anda lewat WhatsApp/telepon untuk konfirmasi jadwal.</p>
    </div>
</section>

<section class="section">
    <div class="container">
    <div class="panel" style="max-width:760px; margin:0 auto;">

        <?php if($services->isEmpty()): ?>
            <div class="empty-state">Belum ada layanan yang tersedia saat ini.</div>
        <?php else: ?>
        <form method="POST" action="<?php echo e(route('booking.store')); ?>" id="bookingForm">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="customer_name" value="<?php echo e(old('customer_name')); ?>" placeholder="Nama lengkap Anda" required>
            </div>

            <div class="form-group">
                <label>Nomor WhatsApp / Telepon</label>
                <input type="text" name="customer_phone" value="<?php echo e(old('customer_phone')); ?>" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label>Pilih Paket Layanan</label>
                <select name="service_id" id="serviceSelect" required>
                    <option value="">-- Pilih Paket --</option>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s->id); ?>"
                            data-tiers='<?php echo json_encode(array_values($s->tiers()), 15, 512) ?>'
                            <?php echo e($selectedService === $s->id ? 'selected' : ''); ?>>
                            <?php echo e($s->name); ?> (<?php echo e((int) $s->duration_minutes); ?> menit)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label>Pilih Sub-Paket</label>
                <select name="tier" id="tierSelect" required>
                    <option value="">-- Pilih layanan dulu --</option>
                </select>
                <div id="tierPriceHint" style="margin-top:8px; font-size:13px; color:#666;"></div>
            </div>

            <div class="form-group">
                <label>Pilih Tanggal Booking</label>

                <div class="booking-calendar" id="bookingCalendar">
                    <div class="booking-calendar-head">
                        <button type="button" class="cal-nav" id="calPrev" aria-label="Bulan sebelumnya">&#8249;</button>
                        <span class="cal-month-label" id="calMonthLabel"></span>
                        <button type="button" class="cal-nav" id="calNext" aria-label="Bulan berikutnya">&#8250;</button>
                    </div>
                    <div class="booking-calendar-weekdays">
                        <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
                    </div>
                    <div class="booking-calendar-grid" id="calGrid"></div>
                    <div class="booking-calendar-legend">
                        <span><i class="dot dot-available"></i> Longgar</span>
                        <span><i class="dot dot-busy"></i> Lumayan Penuh</span>
                        <span><i class="dot dot-full"></i> Padat</span>
                    </div>
                </div>

                <input type="hidden" name="booking_date" id="bookingDate" value="<?php echo e(old('booking_date')); ?>" required>
                <div id="selectedDateLabel" style="margin-top:10px; font-size:13px; color:#555;"></div>
            </div>

            <div class="form-group">
                <label>Jam Booking</label>
                <input type="time" name="booking_time" id="bookingTime" value="<?php echo e(old('booking_time')); ?>" required>
            </div>

            <div id="availabilityHint" style="margin-bottom:16px; font-size:13px;"></div>

            <div class="form-group">
                <label>Catatan Tambahan (opsional)</label>
                <textarea name="notes" rows="4" placeholder="Contoh: konsep foto, jumlah orang, referensi gaya, dll."><?php echo e(old('notes')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block" id="submitBookingBtn">Kirim Booking</button>
        </form>
        <?php endif; ?>

    </div>
    </div>
</section>

<script>
(function () {
    var serviceSelect = document.getElementById('serviceSelect');
    var tierSelect = document.getElementById('tierSelect');
    var priceHint = document.getElementById('tierPriceHint');
    var dateInput = document.getElementById('bookingDate');
    var timeInput = document.getElementById('bookingTime');
    var availabilityHint = document.getElementById('availabilityHint');
    var submitBtn = document.getElementById('submitBookingBtn');
    var selectedDateLabel = document.getElementById('selectedDateLabel');
    var preselectTier = <?php echo json_encode($selectedTier ?: '', 15, 512) ?>;
    var checkUrl = <?php echo json_encode(route('booking.check-availability'), 15, 512) ?>;
    var calendarUrl = <?php echo json_encode(route('booking.calendar-data'), 15, 512) ?>;

    var monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var today = new Date();
    today.setHours(0,0,0,0);
    var viewYear = today.getFullYear();
    var viewMonth = today.getMonth();
    var selectedDate = dateInput.value || null;

    function formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function toDateKey(y, m, d) {
        return y + '-' + pad(m + 1) + '-' + pad(d);
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
            o.setAttribute('data-desc', t.description);
            if (preselectTier && t.key === preselectTier) {
                o.selected = true;
            }
            tierSelect.appendChild(o);
        });

        updateTierHint();
    }

    function updateTierHint() {
        var opt = tierSelect.options[tierSelect.selectedIndex];
        priceHint.textContent = (opt && opt.value) ? (opt.getAttribute('data-desc') || '') : '';
    }

    function checkAvailability() {
        availabilityHint.textContent = '';
        availabilityHint.style.color = '';
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

        fetch(checkUrl + '?' + params.toString(), { headers: { 'Accept': 'application/json' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.available) {
                    availabilityHint.textContent = '✓ Jadwal tersedia.';
                    availabilityHint.style.color = '#1a7d3a';
                    submitBtn.disabled = false;
                } else {
                    availabilityHint.textContent = '✗ Jadwal ini sudah terisi booking lain. Silakan pilih tanggal/jam lain.';
                    availabilityHint.style.color = '#c0392b';
                    submitBtn.disabled = true;
                }
            })
            .catch(function () { availabilityHint.textContent = ''; });
    }

    // ---------- Kalender Visual ----------
    var calGrid = document.getElementById('calGrid');
    var calMonthLabel = document.getElementById('calMonthLabel');
    var calPrev = document.getElementById('calPrev');
    var calNext = document.getElementById('calNext');
    var monthCache = {};

    function busyLevel(count) {
        if (count <= 0) return 'available';
        if (count <= 2) return 'busy';
        return 'full';
    }

    function renderCalendar() {
        calMonthLabel.textContent = monthNames[viewMonth] + ' ' + viewYear;

        var cacheKey = viewYear + '-' + viewMonth;
        var firstDay = new Date(viewYear, viewMonth, 1).getDay();
        var totalDays = new Date(viewYear, viewMonth + 1, 0).getDate();

        function buildGrid(counts) {
            calGrid.innerHTML = '';

            for (var i = 0; i < firstDay; i++) {
                var empty = document.createElement('div');
                empty.className = 'cal-day cal-day-empty';
                calGrid.appendChild(empty);
            }

            for (var d = 1; d <= totalDays; d++) {
                var dateObj = new Date(viewYear, viewMonth, d);
                dateObj.setHours(0,0,0,0);
                var key = toDateKey(viewYear, viewMonth, d);
                var isPast = dateObj < today;

                var cell = document.createElement('button');
                cell.type = 'button';
                cell.className = 'cal-day';
                cell.textContent = d;

                if (isPast) {
                    cell.classList.add('cal-day-disabled');
                    cell.disabled = true;
                } else {
                    var count = counts[key] || 0;
                    cell.classList.add('cal-day-' + busyLevel(count));
                    cell.addEventListener('click', function () {
                        var clickedKey = this.getAttribute('data-key');
                        selectedDate = clickedKey;
                        dateInput.value = clickedKey;
                        dateInput.dispatchEvent(new Event('change'));

                        calGrid.querySelectorAll('.cal-day').forEach(function (el) { el.classList.remove('cal-day-selected'); });
                        this.classList.add('cal-day-selected');

                        var d2 = new Date(clickedKey + 'T00:00:00');
                        var opts = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        selectedDateLabel.textContent = 'Tanggal dipilih: ' + d2.toLocaleDateString('id-ID', opts);
                    });
                }

                cell.setAttribute('data-key', key);
                if (key === selectedDate) cell.classList.add('cal-day-selected');

                calGrid.appendChild(cell);
            }
        }

        if (monthCache[cacheKey]) {
            buildGrid(monthCache[cacheKey]);
            return;
        }

        var params = new URLSearchParams({ year: viewYear, month: viewMonth + 1 });
        fetch(calendarUrl + '?' + params.toString(), { headers: { 'Accept': 'application/json' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                monthCache[cacheKey] = data.counts || {};
                buildGrid(monthCache[cacheKey]);
            })
            .catch(function () { buildGrid({}); });
    }

    calPrev.addEventListener('click', function () {
        viewMonth--;
        if (viewMonth < 0) { viewMonth = 11; viewYear--; }
        renderCalendar();
    });
    calNext.addEventListener('click', function () {
        viewMonth++;
        if (viewMonth > 11) { viewMonth = 0; viewYear++; }
        renderCalendar();
    });

    serviceSelect.addEventListener('change', function () { populateTiers(); checkAvailability(); });
    tierSelect.addEventListener('change', updateTierHint);
    dateInput.addEventListener('change', checkAvailability);
    timeInput.addEventListener('change', checkAvailability);

    if (serviceSelect.value) populateTiers();
    if (selectedDate) {
        var parts = selectedDate.split('-');
        viewYear = parseInt(parts[0], 10);
        viewMonth = parseInt(parts[1], 10) - 1;
    }
    renderCalendar();
    checkAvailability();
})();
</script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/booking.blade.php ENDPATH**/ ?>