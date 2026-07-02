<x-layout title="Masuk">

<div class="auth-wrap">
    <div class="auth-card">
        <h1>Masuk</h1>
        <p class="sub">Masuk ke akun Home Photoworks Anda</p>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>

        <p class="form-hint">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</div>

</x-layout>
