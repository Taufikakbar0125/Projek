<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug',
        'content', 'image', 'status', 'is_archived',
        'views', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_archived'  => 'boolean',
        'views'        => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Berita yang sudah published dan waktunya sudah lewat
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }
}
