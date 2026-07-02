# Home Photoworks — Versi Laravel

Ini adalah hasil konversi dari versi **PHP native** ke **Laravel 11**.
Fitur, alur, dan tampilan (CSS/JS) dibuat sama persis dengan versi aslinya.

> ⚠️ Catatan penting: proyek ini dibuat **tanpa menjalankan `composer install`**
> (dibangun di lingkungan tanpa akses internet/PHP). Struktur file Laravel
> (controllers, models, migrations, routes, views) sudah lengkap dan siap
> pakai — kamu hanya perlu menjalankan `composer install` sekali di
> komputermu untuk mengunduh framework Laravel itu sendiri (folder `vendor/`).

## Struktur Fitur (sama dengan versi PHP native)

- Halaman publik: Beranda, Layanan, Galeri, Tentang, Kontak
- Auth: Login & Register (pakai `Auth` bawaan Laravel, sesi berbasis cookie)
- User: Dashboard, Booking baru, Riwayat pemesanan (+ batalkan), Profil & ganti password
- Admin: Dashboard statistik, Kelola pemesanan (ubah status/hapus), Kelola layanan (CRUD),
  Kelola galeri (upload/hapus foto), Kelola pengguna (ubah role/hapus)

## Langkah Instalasi di VSCode

### 1. Prasyarat
Pastikan sudah terpasang di komputer:
- **PHP 8.2+** (cek dengan `php -v`)
- **Composer** ([getcomposer.org](https://getcomposer.org))
- **MySQL** (bisa lewat XAMPP / Laragon / MySQL native)
- Extension VSCode yang membantu (opsional): *PHP Intelephense*, *Laravel Blade Snippets*

### 2. Buka folder di VSCode
Extract folder `homephotoworks-laravel` lalu buka lewat `File > Open Folder...` di VSCode.

### 3. Install dependency Laravel
Buka terminal di VSCode (`` Ctrl+` ``), lalu jalankan:
```bash
composer install
```
Ini akan mengunduh folder `vendor/` (framework Laravel-nya sendiri).

### 4. Siapkan file environment
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Buat database
Buka phpMyAdmin / MySQL client, buat database kosong bernama `home_photoworks`
(atau sesuaikan nama di file `.env`).

Cek/sesuaikan kredensial di `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=home_photoworks
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Migrasi & seed data awal
```bash
php artisan migrate --seed
```
Perintah ini otomatis membuat seluruh tabel **dan** akun demo (setara `database.sql` + `seed.php` di versi lama):

| Role  | Email                        | Password    |
|-------|------------------------------|-------------|
| Admin | admin@homephotoworks.com     | password123 |
| User  | user@homephotoworks.com      | password123 |

### 7. Jalankan server
```bash
php artisan serve
```
Buka browser ke **http://localhost:8000**

## Struktur Folder Penting
```
homephotoworks-laravel/
├── app/Http/Controllers/     # Logic (Auth, Page, Admin/*, User/*)
├── app/Models/                # User, Service, Gallery, Booking
├── app/Http/Middleware/       # EnsureUserIsAdmin (pengganti requireAdmin())
├── database/migrations/       # Skema tabel (pengganti database.sql)
├── database/seeders/          # Akun demo + data awal (pengganti seed.php)
├── resources/views/           # Blade templates
│   ├── components/            # layout.blade.php & dash-layout.blade.php
│   │                             (pengganti header/footer & dash_header/footer)
│   ├── pages/                 # Beranda, Layanan, Galeri, Tentang, Kontak
│   ├── auth/                  # Login, Register
│   ├── user/                  # Dashboard, Booking, Riwayat, Profil
│   └── admin/                 # Dashboard, Pemesanan, Layanan, Galeri, Pengguna
├── routes/web.php             # Semua rute aplikasi
└── public/                    # Entry point, css/js/gambar, folder upload galeri
```

## Perbedaan dari versi PHP native
- Autentikasi & session sekarang pakai `Auth` facade bawaan Laravel (bukan `$_SESSION` manual).
- Validasi input pakai Laravel Validator (bukan pengecekan manual di tiap file).
- Query database pakai Eloquent ORM (bukan PDO manual).
- Routing terpusat di `routes/web.php` (bukan folder/file terpisah).
- Upload foto galeri disimpan di `public/uploads/gallery/` (fungsinya sama).

## Jika Terjadi Error Saat Instalasi
- **`could not find driver` saat migrate** → aktifkan extension `pdo_mysql` di `php.ini`.
- **Error 500 blank page** → jalankan `php artisan key:generate` dan pastikan folder `storage/` serta `bootstrap/cache/` bisa ditulis (`chmod -R 775 storage bootstrap/cache` di Linux/Mac).
- **Route/View not found setelah edit** → jalankan `php artisan route:clear` dan `php artisan view:clear`.
