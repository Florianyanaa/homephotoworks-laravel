<x-layout title="Daftar">

<div class="auth-wrap">
    <div class="auth-card">
        <h1>Buat Akun</h1>
        <p class="sub">Daftar untuk mulai memesan sesi foto</p>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="{{ route('register.attempt') }}">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Nama Anda" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="0812xxxxxxx">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirm" placeholder="Ulangi password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
        </form>

        <p class="form-hint">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
    </div>
</div>

</x-layout>
