{{--
    Komponen timeline status booking.
    Pakai: @include('partials.booking-timeline', ['status' => $booking->status])
--}}
@php
    $steps = [
        'pending'   => ['label' => 'Menunggu', 'accent' => '#916b00'],
        'confirmed' => ['label' => 'Dikonfirmasi', 'accent' => '#0a4fa0'],
        'completed' => ['label' => 'Selesai', 'accent' => '#157a35'],
    ];
    $order = array_keys($steps);
    $currentIndex = array_search($status, $order, true);
@endphp

@if ($status === 'cancelled')
    <div class="booking-timeline booking-timeline-cancelled">
        <span class="timeline-cancel-dot">&times;</span>
        <span>Pemesanan ini telah dibatalkan</span>
    </div>
@else
    <div class="booking-timeline">
        @foreach ($steps as $key => $step)
            @php
                $stepIndex = array_search($key, $order, true);
                $state = $stepIndex < $currentIndex ? 'done' : ($stepIndex === $currentIndex ? 'current' : 'upcoming');
            @endphp
            <div class="timeline-step timeline-{{ $state }}"
                 @if ($state === 'current') style="--step-accent: {{ $step['accent'] }};" @endif>
                <span class="timeline-dot">{{ $state === 'done' ? '✓' : $stepIndex + 1 }}</span>
                <span class="timeline-label">{{ $step['label'] }}</span>
            </div>
            @if (!$loop->last)
                <span class="timeline-connector {{ $stepIndex < $currentIndex ? 'timeline-connector-done' : '' }}"></span>
            @endif
        @endforeach
    </div>
@endif
