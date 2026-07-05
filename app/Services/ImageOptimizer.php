<?php

namespace App\Services;

class ImageOptimizer
{
    /**
     * Baca gambar dari format apapun (jpg/png/gif/webp), koreksi orientasi
     * EXIF (biar foto dari HP tidak kebalik/miring), resize kalau perlu,
     * lalu simpan sebagai WebP di $destPath.
     */
    public static function toWebp(string $sourcePath, string $destPath, int $maxWidth = 1600, int $quality = 85): bool
    {
        if (! extension_loaded('gd') || ! function_exists('imagewebp') || ! file_exists($sourcePath)) {
            return false;
        }

        $info = @getimagesize($sourcePath);
        if (! $info) {
            return false;
        }

        [, , $type] = $info;

        $source = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG => @imagecreatefrompng($sourcePath),
            IMAGETYPE_GIF => @imagecreatefromgif($sourcePath),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($sourcePath) : null,
            default => null,
        };

        if (! $source) {
            return false;
        }

        // Koreksi orientasi EXIF — kamera HP menyimpan foto potret sebagai data
        // "landscape" + info rotasi terpisah. GD tidak otomatis membaca info ini,
        // jadi kalau tidak dikoreksi manual, hasilnya kebalik/miring 90°/180°.
        if ($type === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $exif = @exif_read_data($sourcePath);
            if ($exif && isset($exif['Orientation'])) {
                $source = self::applyExifOrientation($source, (int) $exif['Orientation']);
            }
        }

        $width = imagesx($source);
        $height = imagesy($source);

        $ratio = $width > $maxWidth ? $maxWidth / $width : 1;
        $newWidth = max(1, (int) round($width * $ratio));
        $newHeight = max(1, (int) round($height * $ratio));

        $resized = imagecreatetruecolor($newWidth, $newHeight);

        // Jaga transparansi (kalau sumbernya PNG/GIF transparan)
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
        imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);

        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $ok = imagewebp($resized, $destPath, $quality);

        imagedestroy($source);
        imagedestroy($resized);

        return $ok;
    }

    /**
     * Terapkan rotasi/flip sesuai kode orientasi EXIF standar (1-8).
     */
    protected static function applyExifOrientation($image, int $orientation)
    {
        switch ($orientation) {
            case 2:
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 4:
                imageflip($image, IMG_FLIP_VERTICAL);
                break;
            case 5:
                $image = imagerotate($image, -90, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 7:
                $image = imagerotate($image, 90, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        return $image;
    }
}
