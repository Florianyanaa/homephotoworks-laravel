<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('bookings');
    }

    public function down(): void
    {
        // Fitur booking sudah dihapus dari aplikasi, jadi tabel ini
        // sengaja tidak dibuat ulang kalau migration di-rollback.
    }
};
