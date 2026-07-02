<x-dash-layout title="Profil Saya" active="profile" role="user">

<div class="panel" style="max-width:600px;">
    <div class="panel-head"><h2>Informasi Akun</h2></div>
    <form method="POST" action="{{ route('user.profile.update') }}">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" value="{{ $user->email }}" disabled style="background:#f5f4f2;">
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<div class="panel" style="max-width:600px;">
    <div class="panel-head"><h2>Ubah Password</h2></div>
    <form method="POST" action="{{ route('user.profile.password') }}">
        @csrf
        <div class="form-group">
            <label>Password Saat Ini</label>
            <input type="password" name="current_password" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-outline">Ubah Password</button>
    </form>
</div>

</x-dash-layout>
