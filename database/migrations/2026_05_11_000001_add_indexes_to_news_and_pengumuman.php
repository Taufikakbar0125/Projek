<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah index pada tabel news dan pengumuman untuk performa query.
 *
 * news: scopePublished() filter (status, published_at) dan join ke category
 * pengumuman: orderBy(tanggal) dan filter(kategori)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // scopePublished() pakai WHERE status = 'published' AND published_at <= now()
            $table->index(['status', 'published_at'], 'news_status_published_at_idx');
            // JOIN / whereHas category
            $table->index('category_id', 'news_category_id_idx');
        });

        Schema::table('pengumuman', function (Blueprint $table) {
            // ORDER BY tanggal DESC — query terberat di halaman publik
            $table->index('tanggal', 'pengumuman_tanggal_idx');
            // WHERE kategori = ? — filter di halaman pengumuman
            $table->index('kategori', 'pengumuman_kategori_idx');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('news_status_published_at_idx');
            $table->dropIndex('news_category_id_idx');
        });

        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropIndex('pengumuman_tanggal_idx');
            $table->dropIndex('pengumuman_kategori_idx');
        });
    }
};
