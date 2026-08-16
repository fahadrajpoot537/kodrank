<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BlogPageSetting extends Model
{
    protected $fillable = ['data'];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public static function defaults(): array
    {
        return [
            'hero_title' => 'The KodRank Blog',
            'hero_lede' => 'Technical breakdowns, playbooks, and the occasional hot take — no filler, no recycled listicles. Written by the strategists and developers running the campaigns.',
            'search_placeholder' => 'Search articles — “core web vitals”, “AEO”, “link building”…',
            'hero_background' => 'media/blog/hero-background.jpg',
            'newsletter_eyebrow' => 'Straight to your inbox',
            'newsletter_title' => 'One technical SEO breakdown, every other week.',
            'newsletter_title_html' => 'One technical SEO breakdown, <span class="hl">every other week.</span>',
            'newsletter_copy' => 'No fluff, no "10 tips" listicles — just the audits, log-file findings, and fixes our team is running right now.',
            'newsletter_fine' => '',
            'newsletter_placeholder' => 'you@company.com',
            'seo_title' => 'Blog — SEO, Web Development & AEO Insights | KodRank',
            'seo_description' => 'The KodRank blog: practical guides on SEO, web development, and answer/generative engine optimization (AEO/GEO) — written by the strategists who run the campaigns.',
            'og_title' => 'Blog — SEO, Web Development & AEO Insights | KodRank',
            'og_description' => 'Practical SEO, web development, and AEO/GEO guides from the KodRank team — no fluff, just what actually moves rankings and revenue.',
        ];
    }

    public static function current(): array
    {
        return Cache::remember('blog_page_settings', 60, function () {
            $row = static::query()->first();
            $data = is_array($row?->data) ? $row->data : [];

            return array_merge(static::defaults(), $data);
        });
    }

    public static function forgetCache(): void
    {
        Cache::forget('blog_page_settings');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::forgetCache());
        static::deleted(fn () => static::forgetCache());
    }
}
