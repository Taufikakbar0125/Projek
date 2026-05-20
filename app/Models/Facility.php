<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    protected $fillable = [
        'name', 'description', 'image', 'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];
}
