<x-layout title="Kontak">

<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Hubungi Kami</span>
        <h1>Mari Diskusikan Sesi Foto Anda</h1>
        <p>Tim kami siap membantu menjawab pertanyaan seputar layanan &amp; jadwal.</p>
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div>
            <span class="eyebrow">Informasi</span>
            <h2 style="margin-bottom: 26px;">Detail Kontak Studio</h2>

            <div class="contact-info-item">
                <h4>Telepon / WhatsApp</h4>
                <p>+62 852-1040-0454</p>
            </div>
            <div class="contact-info-item">
                <h4>Instagram</h4>
                <p><a href="https://www.instagram.com/homephotoworks_official?igsh=MTlna2gwcGE0MGNmcQ%3D%3D&utm_source=qr" target="_blank" rel="noopener">@homephotoworks_official</a></p>
            </div>
            <div class="contact-info-item">
                <h4>Jam Operasional</h4>
                <p>Senin – Minggu: 08.00 – 22.00 WIB</p>
            </div>
        </div>

        <div class="panel" style="margin-bottom:0;">
            <h2 style="margin-bottom:20px;">Kirim Pesan</h2>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">{{ $error }}</div>
                @endforeach
            @endif

            <form method="POST" action="{{ route('kontak.store') }}">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                </div>
                <div class="form-group">
                    <label>Pesan</label>
                    <textarea name="message" rows="5" placeholder="Tuliskan pertanyaan atau kebutuhan Anda..." required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

@if (session('wa_link'))
<script>
    (function () {
        var waWindow = window.open(@json(session('wa_link')), '_blank');
        if (!waWindow) {
            // Kalau popup diblokir browser, tampilkan tombol manual
            var box = document.querySelector('.alert-success');
            if (box) {
                box.insertAdjacentHTML('afterend',
                    '<div class="container"><a href="' + @json(session('wa_link')) + '" target="_blank" rel="noopener" class="btn btn-primary" style="margin:16px 0;">Lanjutkan ke WhatsApp &rarr;</a></div>'
                );
            }
        }
    })();
</script>
@endif

</x-layout>
