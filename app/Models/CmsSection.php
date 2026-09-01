<?php

namespace App\Models;

use App\Support\CmsPageDefaults;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class CmsSection extends Model
{
    protected $fillable = ['key', 'label', 'sort_order', 'data'];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public static function getMap(): array
    {
        if (Schema::hasTable('cms_sections')) {
            CmsPageDefaults::ensure();
        }

        return Cache::remember('cms_sections_map', 60, function () {
            return static::query()
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(fn (self $s) => [$s->key => $s->data])
                ->all();
        });
    }

    public static function forgetCache(): void
    {
        Cache::forget('cms_sections_map');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::forgetCache());
        static::deleted(fn () => static::forgetCache());
    }
}
