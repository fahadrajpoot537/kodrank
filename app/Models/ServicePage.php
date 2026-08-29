<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\SeoServiceImageSitemapService;
use Illuminate\Support\Facades\Cache;

class ServicePage extends Model
{
    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'is_active',
        'sort_order',
        'seo',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'seo' => 'array',
            'sort_order' => 'integer',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order')->orderBy('name');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with(['sections', 'childrenRecursive']);
    }

    /**
     * Nested children for nav/mega menu — never load sections (can be multi‑MB HTML).
     */
    public function childrenNavRecursive(): HasMany
    {
        return $this->children()
            ->where('is_active', true)
            ->with(['childrenNavRecursive']);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(ServicePageSection::class)->orderBy('sort_order');
    }

    public function sectionMap(): array
    {
        return $this->sections
            ->mapWithKeys(fn (ServicePageSection $s) => [$s->key => $s->data])
            ->all();
    }

    public function publicUrl(): string
    {
        return url('/'.$this->slug);
    }

    public function isMain(): bool
    {
        return $this->parent_id === null;
    }

    /**
     * Active descendants for mega menu links (nested subs flattened).
     *
     * @return Collection<int, self>
     */
    public function navDescendants(): Collection
    {
        $items = new Collection;

        $children = $this->relationLoaded('childrenNavRecursive')
            ? $this->childrenNavRecursive
            : ($this->relationLoaded('childrenRecursive')
                ? $this->childrenRecursive
                : $this->children()->where('is_active', true)->with('childrenNavRecursive')->get());

        foreach ($children as $child) {
            if (! $child->is_active) {
                continue;
            }
            if (! empty($child->seo['hide_from_nav'])) {
                continue;
            }
            $items->push($child);
            foreach ($child->navDescendants() as $desc) {
                $items->push($desc);
            }
        }

        return $items;
    }

    /**
     * Main services + nested children for the Services mega menu.
     * Keeps original design: column head = main, list = sub services.
     *
     * @return Collection<int, self>
     */
    public static function navTree(): Collection
    {
        // File store avoids MySQL max_allowed_packet when CACHE_STORE=database.
        return Cache::store('file')->remember('service_pages_nav_tree', 60, function () {
            return static::query()
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->with('childrenNavRecursive')
                ->get(['id', 'parent_id', 'slug', 'name', 'is_active', 'sort_order', 'seo'])
                ->filter(fn (self $page) => empty($page->seo['hide_from_nav'])
                    && strcasecmp((string) $page->slug, 'industries') !== 0
                    && strcasecmp((string) $page->name, 'Industries') !== 0)
                ->values();
        });
    }

    /**
     * @deprecated use navTree()
     *
     * @return Collection<int, self>
     */
    public static function navPages(): Collection
    {
        return static::navTree();
    }

    /**
     * Options for parent select (excludes self + descendants).
     *
     * @return Collection<int, self>
     */
    public static function parentOptions(?int $excludeId = null): Collection
    {
        $pages = static::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'parent_id', 'name']);

        if (! $excludeId) {
            return $pages;
        }

        $blocked = [$excludeId];
        $changed = true;
        while ($changed) {
            $changed = false;
            foreach ($pages as $page) {
                if ($page->parent_id && in_array((int) $page->parent_id, $blocked, true) && ! in_array((int) $page->id, $blocked, true)) {
                    $blocked[] = (int) $page->id;
                    $changed = true;
                }
            }
        }

        return $pages->reject(fn (self $p) => in_array((int) $p->id, $blocked, true))->values();
    }

    public static function findBySlug(string $slug): ?self
    {
        // File store: theme-html pages can be multi‑MB and blow MySQL max_allowed_packet
        // when CACHE_STORE=database.
        return Cache::store('file')->remember("service_page_{$slug}", 60, function () use ($slug) {
            return static::query()
                ->where('slug', $slug)
                ->where('is_active', true)
                ->with(['sections', 'parent:id,slug,name'])
                ->first();
        });
    }

    public static function forgetCache(string $slug): void
    {
        Cache::forget("service_page_{$slug}");
        Cache::store('file')->forget("service_page_{$slug}");
        static::forgetNavCache();
    }

    public static function forgetNavCache(): void
    {
        Cache::forget('service_pages_nav');
        Cache::forget('service_pages_nav_tree');
        Cache::store('file')->forget('service_pages_nav');
        Cache::store('file')->forget('service_pages_nav_tree');
    }

    protected static function booted(): void
    {
        static::saved(function (self $page) {
            static::forgetCache($page->slug);
            if ($page->wasChanged('slug') && $page->getOriginal('slug')) {
                static::forgetCache((string) $page->getOriginal('slug'));
            }
            static::forgetNavCache();
            SeoServiceImageSitemapService::forgetCache();
        });
        static::deleted(function (self $page) {
            static::forgetCache($page->slug);
            static::forgetNavCache();
            SeoServiceImageSitemapService::forgetCache();
        });
    }
}
