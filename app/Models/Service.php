<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_minutes',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Sub-paket di dalam layanan ini: Seikhlasnya, Small, Medium, Large.
     * Harga Small = harga dasar, Medium = 1.5x, Large = 2x.
     * Seikhlasnya tidak punya harga tetap (bayar sesuai keikhlasan).
     */
    public function tiers(): array
    {
        return [
            'seikhlasnya' => [
                'key' => 'seikhlasnya',
                'label' => 'Paket Seikhlasnya',
                'price' => null,
                'description' => 'Bayar sesuai kemampuan dan keikhlasan Anda. Cocok untuk yang ingin coba dulu atau budget terbatas.',
            ],
            'small' => [
                'key' => 'small',
                'label' => 'Paket Small',
                'price' => (float) $this->price,
                'description' => 'Sesi singkat dengan cakupan dasar dari layanan ini — pas untuk kebutuhan simpel.',
            ],
            'medium' => [
                'key' => 'medium',
                'label' => 'Paket Medium',
                'price' => round((float) $this->price * 1.5),
                'description' => 'Sesi lebih lengkap dengan durasi & hasil edit lebih banyak dibanding paket Small.',
            ],
            'large' => [
                'key' => 'large',
                'label' => 'Paket Large',
                'price' => round((float) $this->price * 2),
                'description' => 'Paket paling lengkap — durasi terpanjang, hasil edit terbanyak, dan prioritas jadwal.',
            ],
        ];
    }
}
