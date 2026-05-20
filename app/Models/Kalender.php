<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    protected $table = 'kalender';

    protected $fillable = [
        'tahun_akademik', 'semester', 'file_pdf', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
