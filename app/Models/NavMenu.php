<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class NavMenu extends Model
{
    protected $table = 'nav_menus';

    protected $fillable = [
        'parent_id', 'label', 'url', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavMenu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavMenu::class, 'parent_id')
                    ->orderBy('sort_order');
    }

    // Bersihkan cache navbar saat menu diubah
    protected static function booted(): void
    {
        static::saved(fn()   => Cache::forget('nav_menus'));
        static::deleted(fn() => Cache::forget('nav_menus'));
    }
}
