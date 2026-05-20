<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'value',
        'content',
        'color',      // warna teks & ikon (hex, cth: #0d6efd)
        'subtitle',   // deskripsi singkat untuk agenda & carousel
        'event_date', // tanggal event untuk type=agenda
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
