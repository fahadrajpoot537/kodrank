<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'content_html',
        'table_of_contents',
        'tag_label',
        'post_tags',
        'inline_cta_title',
        'inline_cta_body',
        'inline_cta_text',
        'inline_cta_url',
        'author_name',
        'author_role',
        'author_bio',
        'author_linkedin',
        'author_image',
        'featured_image',
        'featured_image_alt',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_image',
        'og_image_alt',
        'read_minutes',
        'published_at',
        'is_published',
        'is_featured',
        'is_editors_pick',
        'show_in_latest',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'table_of_contents' => 'array',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'is_editors_pick' => 'boolean',
            'show_in_latest' => 'boolean',
            'read_minutes' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function authorAvatarPath(): ?string
    {
        $custom = trim((string) $this->author_image);
        if ($custom !== '') {
            $path = ltrim($custom, '/');

            return is_file(public_path($path)) ? $path : $path;
        }

        return \App\Support\BlogAuthors::imagePathForName($this->author_name);
    }

    public function authorLinkedInUrl(): ?string
    {
        $custom = trim((string) $this->author_linkedin);
        if ($custom !== '') {
            return $custom;
        }

        return \App\Support\BlogAuthors::findByName($this->author_name)['linkedin'] ?? null;
    }

    public function authorInitials(): string
    {
        $parts = preg_split('/\s+/', trim((string) $this->author_name)) ?: [];
        $initials = '';
        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= mb_strtoupper(mb_substr($part, 0, 1));
        }

        return $initials !== '' ? $initials : 'KR';
    }

    public function formattedDate(): string
    {
        return $this->published_at ? $this->published_at->format('M j, Y') : '';
    }
}
