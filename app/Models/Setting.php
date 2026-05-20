<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['key', 'type', 'value'];

    /**
     * Ambil URL/nilai setting berdasarkan key.
     * Cache 1 jam — otomatis dibersihkan saat setting diupdate/delete.
     */
    public static function getLink(string $key, string $default = '#'): string
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = self::where('key', $key)->first();

            if (!$setting || empty($setting->value)) {
                return $default;
            }

            if (in_array($setting->type, ['image', 'pdf'])) {
                return Storage::disk('public')->url($setting->value);
            }

            return $setting->value;
        });
    }

    /**
     * Helper untuk admin panel — ambil URL dari record ini
     */
    public function getUrl(): ?string
    {
        if (!$this->value) return null;

        if (in_array($this->type, ['image', 'pdf'])) {
            return Storage::disk('public')->url($this->value);
        }

        return $this->value;
    }

    /**
     * Bersihkan cache otomatis saat data diubah/dihapus
     */
    protected static function booted(): void
    {
        static::saved(fn($s)   => Cache::forget("setting_{$s->key}"));
        static::deleted(fn($s) => Cache::forget("setting_{$s->key}"));
    }
}
