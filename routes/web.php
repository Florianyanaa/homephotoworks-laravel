<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PageController;
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
Route::post('/kontak', [ContactMessageController::class, 'store'])->name('kontak.store');

/*
|--------------------------------------------------------------------------
| Login Admin (tidak ada registrasi publik — hanya admin yang punya akun)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Area Admin (harus login + role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
    Route::post('/services/{id}/delete', [AdminServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::post('/gallery/{id}/delete', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/role', [AdminUserController::class, 'toggleRole'])->name('users.role');
    Route::post('/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{id}/read', [AdminMessageController::class, 'markRead'])->name('messages.read');
    Route::post('/messages/{id}/delete', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
});
