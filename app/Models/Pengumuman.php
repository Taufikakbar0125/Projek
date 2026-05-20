<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul', 'tanggal', 'kategori', 'isi', 'file_pdf',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
