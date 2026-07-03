<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MyBookingController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/layanan/{service}', [PageController::class, 'layananShow'])->name('layanan.show');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{gallery}', [PageController::class, 'galeriShow'])->name('galeri.show');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/lokasi', [PageController::class, 'lokasi'])->name('lokasi');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Area Pengguna (harus login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/my-bookings', [MyBookingController::class, 'index'])->name('my-bookings');
    Route::post('/my-bookings/{id}/cancel', [MyBookingController::class, 'cancel'])->name('my-bookings.cancel');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| Area Admin (harus login + role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.status');
    Route::post('/bookings/{id}/delete', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
    Route::post('/services/{id}/delete', [AdminServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::post('/gallery/{id}/delete', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/role', [AdminUserController::class, 'toggleRole'])->name('users.role');
    Route::post('/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('users.destroy');
});
