<?php
// Cara pakai: php check-exif.php "C:\path\ke\foto.jpg"
// Taruh file ini di folder mana saja, jalankan lewat terminal.

if ($argc < 2) {
    echo "Cara pakai: php check-exif.php \"path/ke/foto.jpg\"\n";
    exit(1);
}

$path = $argv[1];

if (! file_exists($path)) {
    echo "File tidak ditemukan: {$path}\n";
    exit(1);
}

echo "=== Info Dasar ===\n";
$info = getimagesize($path);
echo "Lebar x Tinggi (data mentah): {$info[0]} x {$info[1]}\n";
echo "Tipe: " . image_type_to_mime_type($info[2]) . "\n\n";

echo "=== Cek Fungsi EXIF ===\n";
echo "exif_read_data tersedia: " . (function_exists('exif_read_data') ? 'YA' : 'TIDAK') . "\n\n";

if (function_exists('exif_read_data')) {
    $exif = @exif_read_data($path);
    if ($exif === false) {
        echo "Hasil: gagal baca EXIF (kemungkinan besar metadata sudah terhapus,\n";
        echo "misal karena pernah dikirim lewat WhatsApp/Instagram/aplikasi edit).\n";
    } else {
        echo "Orientation value: " . ($exif['Orientation'] ?? '(tidak ada tag Orientation)') . "\n";
        echo "\n=== Semua data EXIF (untuk referensi) ===\n";
        print_r($exif);
    }
}
