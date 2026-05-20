<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'is_active', 'countdown_to', 'message',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'countdown_to' => 'datetime',
    ];
}
