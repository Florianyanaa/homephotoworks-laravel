<?php

/**
 * Konfigurasi mode "Coming Soon".
 *
 * COMING_SOON_ENABLED = saklar utama. Kalau true, SEMUA halaman publik
 * otomatis diganti jadi halaman countdown, dan hanya admin yang login
 * yang masih bisa akses web aslinya. Kalau false, web berjalan normal.
 *
 * COMING_SOON_LAUNCH_AT = tanggal/jam target launching yang ditampilkan
 * di countdown timer. Ini CUMA tampilan visual — begitu waktunya habis,
 * web TIDAK otomatis kebuka sendiri. Kamu tetap harus ubah
 * COMING_SOON_ENABLED jadi false secara manual pas beneran siap launching.
 */
return [
    'enabled' => env('COMING_SOON_ENABLED', false),
    'launch_at' => env('COMING_SOON_LAUNCH_AT'),
];
