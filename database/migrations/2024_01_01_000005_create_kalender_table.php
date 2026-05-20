<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_akademik');
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('file_pdf')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender');
    }
};
