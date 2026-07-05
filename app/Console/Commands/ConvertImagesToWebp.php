<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use App\Models\Service;
use App\Services\ImageOptimizer;
use Illuminate\Console\Command;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:convert-webp';

    protected $description = 'Konversi semua foto galeri, layanan, dan hero yang sudah ada ke format WebP (kompres ukuran file tanpa mengurangi ketajaman)';

    public function handle(): int
    {
        $this->info('Mulai konversi foto ke WebP...');

        $this->convertGallery();
        $this->convertServices();
        $this->convertHero();

        $this->info('Selesai! Semua foto yang belum WebP sudah dikonversi.');

        return self::SUCCESS;
    }

    protected function convertGallery(): void
    {
        $uploadDir = public_path('uploads/gallery');
        $items = Gallery::whereNotNull('image')->get();
        $count = 0;

        foreach ($items as $item) {
            if (! $item->image || str_ends_with($item->image, '.webp')) {
                continue;
            }

            $sourcePath = $uploadDir.'/'.$item->image;
            if (! file_exists($sourcePath)) {
                continue;
            }

            $webpName = 'gal_'.time().'_'.random_int(1000, 9999).'.webp';
            $converted = ImageOptimizer::toWebp($sourcePath, $uploadDir.'/'.$webpName, 1600, 85);

            if ($converted) {
                @unlink($sourcePath);
                $item->update(['image' => $webpName]);
                $count++;
                $this->line("  Galeri #{$item->id} ({$item->title}) -> {$webpName}");
            }
        }

        $this->info("Galeri: {$count} foto dikonversi.");
    }

    protected function convertServices(): void
    {
        $uploadDir = public_path('uploads/services');
        $items = Service::whereNotNull('image')->get();
        $count = 0;

        foreach ($items as $item) {
            if (! $item->image || str_ends_with($item->image, '.webp')) {
                continue;
            }

            $sourcePath = $uploadDir.'/'.$item->image;
            if (! file_exists($sourcePath)) {
                continue;
            }

            $webpName = 'svc_'.time().'_'.random_int(1000, 9999).'.webp';
            $converted = ImageOptimizer::toWebp($sourcePath, $uploadDir.'/'.$webpName, 1200, 85);

            if ($converted) {
                @unlink($sourcePath);
                $item->update(['image' => $webpName]);
                $count++;
                $this->line("  Layanan #{$item->id} ({$item->name}) -> {$webpName}");
            }
        }

        $this->info("Layanan: {$count} foto dikonversi.");
    }

    protected function convertHero(): void
    {
        $heroDir = public_path('img/hero');
        if (! is_dir($heroDir)) {
            return;
        }

        $count = 0;
        $files = glob($heroDir.'/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);

        foreach ($files as $sourcePath) {
            $webpName = pathinfo($sourcePath, PATHINFO_FILENAME).'.webp';
            $destPath = $heroDir.'/'.$webpName;

            if (file_exists($destPath)) {
                continue; // sudah pernah dikonversi sebelumnya
            }

            $converted = ImageOptimizer::toWebp($sourcePath, $destPath, 1920, 85);

            if ($converted) {
                @unlink($sourcePath);
                $count++;
                $this->line('  Hero: '.basename($sourcePath)." -> {$webpName}");
            }
        }

        $this->info("Hero: {$count} foto dikonversi.");
    }
}
