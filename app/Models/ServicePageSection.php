<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePageSection extends Model
{
    protected $fillable = [
        'service_page_id',
        'key',
        'label',
        'sort_order',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(ServicePage::class, 'service_page_id');
    }

    protected static function booted(): void
    {
        static::saved(function (self $section) {
            $slug = $section->page?->slug;
            if ($slug) {
                ServicePage::forgetCache($slug);
            }
            \App\Services\SeoServiceImageSitemapService::forgetCache();
        });
        static::deleted(function (self $section) {
            $slug = $section->page?->slug;
            if ($slug) {
                ServicePage::forgetCache($slug);
            }
            \App\Services\SeoServiceImageSitemapService::forgetCache();
        });
    }
}
