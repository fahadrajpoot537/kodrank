<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use App\Models\CmsSection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $c = CmsSection::getMap();
        $settings = BlogPageSetting::current();
        $q = trim((string) $request->query('q', ''));
        $tag = trim((string) $request->query('tag', ''));
        $category = strtolower(trim((string) $request->query('category', 'all')));
        $categories = BlogCategory::query()->orderBy('sort_order')->orderBy('name')->get();

        if ($category !== 'all' && ! $categories->contains('slug', $category)) {
            $category = 'all';
        }

        $base = BlogPost::query()
            ->published()
            ->with('category');

        if ($q !== '') {
            $base->where(function ($query) use ($q) {
                $query->where('title', 'like', '%'.$q.'%')
                    ->orWhere('excerpt', 'like', '%'.$q.'%')
                    ->orWhere('tag_label', 'like', '%'.$q.'%')
                    ->orWhere('author_name', 'like', '%'.$q.'%')
                    ->orWhere('body', 'like', '%'.$q.'%');
            });
        }

        $isFiltered = $category !== 'all' || $q !== '' || $tag !== '';
        $filtered = collect();
        $filterLabel = 'All posts';

        if ($isFiltered) {
            $filteredQuery = clone $base;
            if ($category !== 'all') {
                $cat = BlogCategory::query()->where('slug', $category)->first();
                if ($cat) {
                    $filteredQuery->where('category_id', $cat->id);
                    $filterLabel = $cat->name;
                }
            }

            if ($tag !== '') {
                $filteredQuery->where('tag_label', $tag);
                $filterLabel = $filterLabel === 'All posts' ? $tag : $filterLabel.' · '.$tag;
            }

            if ($q !== '') {
                $filterLabel = $category === 'all' && $tag === ''
                    ? 'Search: “'.$q.'”'
                    : $filterLabel.' · “'.$q.'”';
            }

            $filtered = $filteredQuery
                ->orderByDesc('is_featured')
                ->orderByDesc('published_at')
                ->orderBy('sort_order')
                ->get();
        }

        $latest = collect();
        $editorsPicks = collect();
        $byCategory = [];
        $topicCounts = [];
        if (! $isFiltered) {
            $latest = (clone $base)
                ->where('show_in_latest', true)
                ->orderByDesc('is_featured')
                ->orderByDesc('published_at')
                ->orderBy('sort_order')
                ->limit(6)
                ->get();

            $editorsPicks = (clone $base)
                ->where('is_editors_pick', true)
                ->orderBy('sort_order')
                ->orderByDesc('published_at')
                ->limit(4)
                ->get();

            foreach ($categories as $cat) {
                $byCategory[$cat->slug] = (clone $base)
                    ->where('category_id', $cat->id)
                    ->orderBy('sort_order')
                    ->orderByDesc('published_at')
                    ->limit(4)
                    ->get();

                $topicCounts[$cat->slug] = BlogPost::query()
                    ->published()
                    ->where('category_id', $cat->id)
                    ->whereNotNull('tag_label')
                    ->where('tag_label', '!=', '')
                    ->selectRaw('tag_label, COUNT(*) as total')
                    ->groupBy('tag_label')
                    ->orderByDesc('total')
                    ->pluck('total', 'tag_label');
            }
        }

        $seo = [
            'seo_title' => $settings['seo_title'] ?? null,
            'seo_description' => $settings['seo_description'] ?? null,
            'og_title' => $settings['og_title'] ?? null,
            'og_description' => $settings['og_description'] ?? null,
            'og_image' => $settings['hero_background'] ?? 'media/blog/hero-background.jpg',
            'canonical_url' => url('/blogs'),
        ];

        return view('blog.index', compact(
            'c',
            'settings',
            'latest',
            'editorsPicks',
            'categories',
            'byCategory',
            'topicCounts',
            'q',
            'tag',
            'category',
            'isFiltered',
            'filtered',
            'filterLabel',
            'seo'
        ));
    }

    public function show(string $slug): View
    {
        $c = CmsSection::getMap();
        $settings = BlogPageSetting::current();

        $post = BlogPost::query()
            ->published()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = BlogPost::query()
            ->published()
            ->with('category')
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn ($query) => $query->where('category_id', $post->category_id))
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $seo = [
            'seo_title' => $post->seo_title ?: $post->title.' | KodRank Blog',
            'seo_description' => $post->seo_description ?: ($post->excerpt ?: ($settings['seo_description'] ?? '')),
            'keywords' => $post->seo_keywords ?: '',
            'robots' => $post->robots ?: 'index, follow',
            'og_title' => $post->og_title ?: ($post->seo_title ?: $post->title),
            'og_description' => $post->og_description ?: ($post->seo_description ?: ($post->excerpt ?: ($settings['og_description'] ?? ''))),
            'og_image' => $post->og_image ?: ($post->featured_image ?: ($settings['hero_background'] ?? 'media/blog/hero-background.jpg')),
            'og_image_alt' => $post->og_image_alt ?: $post->featured_image_alt,
            'og_type' => 'article',
            'canonical_url' => $post->canonical_url ?: url('/blogs/'.$post->slug),
        ];

        return view('blog.show', compact('c', 'settings', 'post', 'related', 'seo'));
    }
}
