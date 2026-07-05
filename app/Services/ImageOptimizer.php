<?php

namespace App\Services;

class ImageOptimizer
{
    /**
     * Kompres & resize gambar in-place di path yang sama.
     * Foto dari HP biasanya 3-10MB — ini diturunkan ke ukuran wajar
     * untuk web (max lebar tertentu + kualitas JPEG 80) tanpa
     * kelihatan bedanya di layar, tapi jauh lebih ringan didownload.
     */
    public static function optimize(string $path, int $maxWidth = 1600, int $quality = 80): void
    {
        if (! extension_loaded('gd') || ! file_exists($path)) {
            return; // aman: kalau GD tidak ada, biarkan file asli tanpa dioptimasi
        }

        $info = @getimagesize($path);
        if (! $info) {
            return;
        }

        [$width, $height, $type] = $info;

        // Kalau gambar sudah cukup kecil, tidak perlu diresize, cukup dikompres
        $ratio = $width > $maxWidth ? $maxWidth / $width : 1;
        $newWidth = (int) round($width * $ratio);
        $newHeight = (int) round($height * $ratio);

        $source = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
            IMAGETYPE_PNG => @imagecreatefrompng($path),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            default => null,
        };

        if (! $source) {
            return;
        }

        $resized = imagecreatetruecolor($newWidth, $newHeight);

        // Pertahankan transparansi untuk PNG
        if ($type === IMAGETYPE_PNG) {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
        }

        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        match ($type) {
            IMAGETYPE_PNG => imagepng($resized, $path, 8),
            IMAGETYPE_WEBP => function_exists('imagewebp') ? imagewebp($resized, $path, $quality) : imagejpeg($resized, $path, $quality),
            default => imagejpeg($resized, $path, $quality),
        };

        imagedestroy($source);
        imagedestroy($resized);
    }
}
