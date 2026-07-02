<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed akun demo, paket layanan, dan galeri awal
     * (setara dengan database.sql + seed.php pada versi PHP native).
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@homephotoworks.com'],
            [
                'full_name' => 'Admin Home Photoworks',
                'phone' => '081234567890',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@homephotoworks.com'],
            [
                'full_name' => 'Pengguna Demo',
                'phone' => '081298765432',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        $services = [
            ['name' => 'Paket Portrait Klasik', 'description' => 'Sesi foto portrait individu dengan pencahayaan studio profesional, cocok untuk keperluan personal branding.', 'price' => 350000, 'duration_minutes' => 60],
            ['name' => 'Paket Prewedding Elegan', 'description' => 'Sesi foto prewedding dengan konsep monokrom elegan, termasuk 2 outfit dan 20 foto edit.', 'price' => 1500000, 'duration_minutes' => 180],
            ['name' => 'Paket Keluarga Harmoni', 'description' => 'Sesi foto keluarga di studio dengan konsep hangat dan natural, cocok untuk momen kebersamaan.', 'price' => 600000, 'duration_minutes' => 90],
            ['name' => 'Paket Produk & Katalog', 'description' => 'Sesi foto produk untuk kebutuhan katalog dan e-commerce dengan latar putih bersih.', 'price' => 250000, 'duration_minutes' => 45],
            ['name' => 'Paket Graduation', 'description' => 'Sesi foto wisuda dengan berbagai pilihan latar dan properti studio.', 'price' => 300000, 'duration_minutes' => 45],
            ['name' => 'Paket Maternity', 'description' => 'Sesi foto kehamilan dengan pencahayaan lembut dan konsep elegan minimalis.', 'price' => 700000, 'duration_minutes' => 90],
        ];
        foreach ($services as $s) {
            Service::firstOrCreate(['name' => $s['name']], $s);
        }

        $gallery = [
            ['title' => 'Portrait Monokrom', 'category' => 'Portrait', 'image' => 'placeholder-gallery.jpg'],
            ['title' => 'Prewedding Elegan', 'category' => 'Prewedding', 'image' => 'placeholder-gallery.jpg'],
            ['title' => 'Keluarga Bahagia', 'category' => 'Keluarga', 'image' => 'placeholder-gallery.jpg'],
            ['title' => 'Produk Fashion', 'category' => 'Produk', 'image' => 'placeholder-gallery.jpg'],
            ['title' => 'Wisuda Ceria', 'category' => 'Graduation', 'image' => 'placeholder-gallery.jpg'],
            ['title' => 'Maternity Lembut', 'category' => 'Maternity', 'image' => 'placeholder-gallery.jpg'],
        ];
        foreach ($gallery as $g) {
            Gallery::firstOrCreate(['title' => $g['title']], $g);
        }
    }
}
