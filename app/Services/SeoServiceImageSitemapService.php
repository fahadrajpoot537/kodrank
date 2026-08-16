<?php

namespace App\Services;

use App\Models\ServicePage;
use Illuminate\Support\Facades\Cache;

class SeoServiceImageSitemapService
{
    /**
     * Build Google image sitemap XML for SEO service pages.
     */
    public function toXml(): string
    {
        return Cache::remember('seo_service_image_sitemap', 300, function () {
            $pages = ServicePage::query()
                ->where('is_active', true)
                ->whereIn('slug', [
                    'on-page-seo-services',
                    'off-page-seo-services',
                    'technical-seo-services',
                    'geo-services',
                    'about-us',
                ])
                ->with('sections')
                ->get();

            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
            $xml .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

            foreach ($pages as $page) {
                $images = $this->collectImages($page);
                if ($images === []) {
                    continue;
                }

                $xml .= '<url>';
                $xml .= '<loc>'.e($page->publicUrl()).'</loc>';
                foreach ($images as $image) {
                    $xml .= '<image:image>';
                    $xml .= '<image:loc>'.e($image['loc']).'</image:loc>';
                    if ($image['title'] !== '') {
                        $xml .= '<image:title>'.e($image['title']).'</image:title>';
                    }
                    if ($image['caption'] !== '') {
                        $xml .= '<image:caption>'.e($image['caption']).'</image:caption>';
                    }
                    $xml .= '</image:image>';
                }
                $xml .= '</url>';
            }

            $xml .= '</urlset>';

            return $xml;
        });
    }

    public static function forgetCache(): void
    {
        Cache::forget('seo_service_image_sitemap');
    }

    /**
     * @return list<array{loc:string,title:string,caption:string}>
     */
    private function collectImages(ServicePage $page): array
    {
        $found = [];
        $seen = [];

        $seo = $page->seo ?? [];
        if (! empty($seo['og_image'])) {
            $this->pushImage($found, $seen, (string) $seo['og_image'], $page->name, $seo['seo_description'] ?? '');
        }

        foreach ($page->sections as $section) {
            $this->walk($section->data ?? [], $found, $seen, $page->name);
        }

        return $found;
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  list<array{loc:string,title:string,caption:string}>  $found
     * @param  array<string, true>  $seen
     */
    private function walk(array $data, array &$found, array &$seen, string $fallbackTitle): void
    {
        $path = $data['image'] ?? $data['src'] ?? $data['bg_image'] ?? null;
        if (is_string($path) && $path !== '') {
            $title = (string) ($data['image_title'] ?? $data['image_alt'] ?? $data['title'] ?? $fallbackTitle);
            $caption = (string) ($data['image_caption'] ?? $data['image_alt'] ?? $data['visual_aria_label'] ?? $data['lede'] ?? '');
            $this->pushImage($found, $seen, $path, $title, $caption);
        }

        foreach ($data as $value) {
            if (is_array($value)) {
                $this->walk($value, $found, $seen, $fallbackTitle);
            }
        }
    }

    /**
     * @param  list<array{loc:string,title:string,caption:string}>  $found
     * @param  array<string, true>  $seen
     */
    private function pushImage(array &$found, array &$seen, string $path, string $title, string $caption): void
    {
        if (str_starts_with($path, 'data:')) {
            return;
        }

        $loc = str_starts_with($path, 'http') ? $path : asset(ltrim($path, '/'));
        if (isset($seen[$loc])) {
            return;
        }
        $seen[$loc] = true;

        $found[] = [
            'loc' => $loc,
            'title' => trim(strip_tags($title)),
            'caption' => trim(strip_tags($caption)),
        ];
    }
}
