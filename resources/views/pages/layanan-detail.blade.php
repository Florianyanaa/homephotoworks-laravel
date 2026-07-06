<x-layout :title="$service->name">

@php $svcImgPath = $service->image ? public_path('uploads/services/' . $service->image) : null; @endphp

<section class="page-hero" style="padding-bottom:0;">
    <div class="container">
        <span class="eyebrow"><a href="{{ route('layanan') }}" style="color:inherit;">&larr; Kembali ke Layanan</a></span>
        <h1>{{ $service->name }}</h1>
        <p>{{ $service->description }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <img loading="lazy" src="{{ $svcImgPath && file_exists($svcImgPath) ? asset('uploads/services/' . $service->image) : asset('img/placeholder-service.jpg') }}"
             alt="{{ $service->name }}"
             style="width:100%; max-height:420px; object-fit:cover; border-radius: var(--radius); margin-bottom:48px;">

        <div class="section-head reveal-on-scroll">
            <span class="eyebrow">Pilih Sub-Paket</span>
            <h2>Sesuaikan dengan Kebutuhan &amp; Budget Anda</h2>
            <p>Setiap sub-paket punya cakupan berbeda dari layanan "{{ $service->name }}" di atas.</p>
        </div>

        <div class="grid-3" style="align-items:stretch;">
            @foreach ($service->tiers() as $tier)
            <div class="service-card reveal-on-scroll" style="display:flex; flex-direction:column;">
                <div class="service-body" style="display:flex; flex-direction:column; flex:1;">
                    <h3>{{ $tier['label'] }}</h3>
                    <p style="min-height:80px;">{{ $tier['description'] }}</p>
                    <div class="service-meta" style="margin-top:auto;">
                        @if ($tier['price'] === null)
                            <span class="price-tag" style="font-size:17px;">Sesuai Keikhlasan</span>
                        @else
                            <span class="price-tag">Rp {{ number_format($tier['price'], 0, ',', '.') }}</span>
                        @endif
                    </div>
                    @auth
                        @if (!auth()->user()->isAdmin())
                            <a href="{{ route('user.booking.create', ['service_id' => $service->id, 'tier' => $tier['key']]) }}" class="btn btn-primary btn-block">Booking {{ $tier['label'] }}</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block">Masuk untuk Booking</a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>Masih Bingung Pilih Sub-Paket?</h2>
        <p>Konsultasikan kebutuhan foto Anda dulu, tim kami bantu rekomendasikan yang paling pas.</p>
        <a href="{{ route('kontak') }}" class="btn btn-light">Hubungi Kami</a>
    </div>
</section>

</x-layout>
