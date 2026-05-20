<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('information', function (Blueprint $table) {
            // Warna teks & ikon untuk statistik dan agenda
            $table->string('color', 20)->default('#0d6efd')->after('content');
            // Subjudul / deskripsi singkat (untuk agenda & carousel)
            $table->string('subtitle')->nullable()->after('color');
            // Tanggal event khusus untuk type=agenda
            $table->date('event_date')->nullable()->after('subtitle');
        });
    }

    public function down(): void
    {
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn(['color', 'subtitle', 'event_date']);
        });
    }
};
