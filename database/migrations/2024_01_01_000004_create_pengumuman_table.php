<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->enum('kategori', ['Penting', 'Akademik', 'Umum'])->default('Umum');
            $table->text('isi')->nullable();
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
