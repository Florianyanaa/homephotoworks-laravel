<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('tier_key', 30)->nullable()->after('service_id');
            $table->string('tier_label', 100)->nullable()->after('tier_key');
            $table->decimal('tier_price', 12, 2)->nullable()->after('tier_label');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['tier_key', 'tier_label', 'tier_price']);
        });
    }
};
