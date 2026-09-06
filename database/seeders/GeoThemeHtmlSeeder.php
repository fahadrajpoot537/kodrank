<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ThemeHtmlImporter;
use Illuminate\Database\Seeder;

/**
 * GEO Services only — imports theme HTML into /geo-services.
 * Does not touch any other service page.
 *
 * - Shared KodRank hero (breadcrumbs stay); no "GEO SERVICES & AI SEARCH VISIBILITY" eyebrow
 * - Skips final CTA band ("GEO SERVICES, READY WHEN YOU ARE" / Are you in the answer?)
 * - CSS scoped to .geo-theme-page + page-only extras
 *
 * Run:
 *   php artisan db:seed --class=GeoThemeHtmlSeeder
 */
class GeoThemeHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $htmlPath = public_path('theme/kodrank-geo-landing-page/geo-services.html');
        if (! is_file($htmlPath)) {
            $this->command?->error('Missing theme HTML: '.$htmlPath);

            return;
        }

        $mediaFrom = public_path('theme/kodrank-geo-landing-page');
        $mediaTo = 'media/services/geo';
        $cssRel = 'css/theme-geo.css';
        $scope = 'geo-theme-page';
        $slug = 'geo-services';
        $name = 'GEO Services';

        try {
            ThemeHtmlImporter::copyDirImages($mediaFrom, $mediaTo);
            $extracted = ThemeHtmlImporter::extract($htmlPath, $mediaTo);
            ThemeHtmlImporter::writeCss($cssRel, $extracted['css'] ?? '', $scope);
        } catch (\Throwable $e) {
            $this->command?->error($slug.': '.$e->getMessage());

            return;
        }

        $html = trim((string) ($extracted['html'] ?? ''));
        if ($html === '') {
            $this->command?->error('Empty HTML after extract: '.$slug);

            return;
        }

        // Strip mid-page final CTA (huge base64 inside — do not use naive regex).
        $html = $this->stripFinalCta($html);
        // Theme contact replaced by shared Laravel form at render.
        $html = $this->stripContact($html);

        $rawTheme = (string) file_get_contents($htmlPath);
        $hero = $this->parseHeroFromTheme($rawTheme, $extracted['hero'] ?? []);

        // User request: no "GEO SERVICES & AI SEARCH VISIBILITY" eyebrow — breadcrumbs only.
        unset($hero['eyebrow']);
        $hero['eyebrow'] = '';

        if (($hero['title'] ?? '') === '' && ($hero['title_html'] ?? '') === '') {
            $hero['title'] = $name;
        }
        $hero['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => $name, 'url' => ''],
        ];
        $hero['cta_url'] = '#contact';
        if (($hero['cta_text'] ?? '') === '') {
            $hero['cta_text'] = 'Get My Free AI Visibility Audit';
        }

        $heroImage = (string) ($hero['image'] ?? '');
        if ($heroImage === '' || ! is_file(public_path($heroImage))) {
            $fallback = $mediaTo.'/geo-services-ai-search-visibility-hero-kodrank.webp';
            if (is_file(public_path($fallback))) {
                $hero['image'] = $fallback;
            } elseif ($heroImage === '') {
                $saved = $this->extractHeroImageFromTheme($rawTheme, $mediaTo);
                if ($saved !== '') {
                    $hero['image'] = $saved;
                }
            }
        }

        $title = ($extracted['title'] ?? '') !== '' ? $extracted['title'] : ($name.' | KodRank');
        $desc = $extracted['description'] ?? '';
        if ($desc === '' && ! empty($hero['lede'])) {
            $desc = (string) $hero['lede'];
        }

        $parentId = ServicePage::query()->where('slug', 'digital-marketing-services')->value('id');
        $storedHtmlPath = ThemeHtmlImporter::storeHtmlFile($slug, $html);

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'parent_id' => $parentId,
                'name' => $name,
                'is_active' => true,
                'sort_order' => 15,
                'seo' => [
                    'theme' => 'theme-html',
                    'css' => $cssRel,
                    'extra_css' => 'css/theme-geo-page.css',
                    'hide_from_nav' => false,
                    'seo_title' => $title,
                    'seo_description' => $desc,
                    'og_title' => $title,
                    'og_description' => $desc,
                    'og_image' => $hero['image'] ?? '',
                    'keywords' => 'GEO services, generative engine optimization, AI search visibility, ChatGPT citations, KodRank',
                    'robots' => ($extracted['robots'] ?? '') !== '' ? $extracted['robots'] : 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'hero',
            'label' => 'Hero (KodRank)',
            'sort_order' => 0,
            'data' => $hero,
        ]);

        ServicePageSection::query()->create([
            'service_page_id' => $page->id,
            'key' => 'body',
            'label' => 'Theme body (below hero)',
            'sort_order' => 1,
            'data' => [
                'html' => '',
                'html_path' => $storedHtmlPath,
                'scope' => $scope,
            ],
        ]);

        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();

        $this->command?->info('OK '.$slug.' — eyebrow + final CTA skipped, CSS scoped to .'.$scope);
        $this->command?->info('Hero badges: '.count($hero['badges'] ?? []).' | image: '.($hero['image'] ?? '').' | body: '.$storedHtmlPath);
    }

    /**
     * GEO theme uses <header class="hero"> with a huge base64 image —
     * ThemeHtmlImporter's non-greedy regex often fails to extract it.
     *
     * @param  array<string, mixed>  $fallback
     * @return array<string, mixed>
     */
    private function parseHeroFromTheme(string $raw, array $fallback): array
    {
        $end = stripos($raw, '</header>');
        if ($end === false) {
            return $fallback;
        }
        $start = strripos(substr($raw, 0, $end), '<header');
        if ($start === false) {
            return $fallback;
        }
        $chunk = substr($raw, $start, $end + strlen('</header>') - $start);
        // Drop data URIs so parsing stays light
        $chunk = preg_replace('/src="data:image\/[^"]+"/i', 'src=""', $chunk) ?? $chunk;

        $hero = $fallback;

        if (preg_match('/<h1\b[^>]*>(.*?)<\/h1>/is', $chunk, $m)) {
            $hero['title_html'] = trim($m[1]);
            $hero['title'] = trim(preg_replace('/\s+/', ' ', strip_tags(str_replace(['<br>', '<br/>', '<br />'], ' ', $m[1]))) ?? '');
        }

        if (preg_match('/<p\b[^>]*class=["\'][^"\']*\blede\b[^"\']*["\'][^>]*>(.*?)<\/p>/is', $chunk, $m)) {
            $hero['lede'] = trim(strip_tags($m[1]));
        }

        if (preg_match('/<a\b[^>]*class=["\'][^"\']*\bbtn-primary\b[^"\']*["\'][^>]*>(.*?)<\/a>/is', $chunk, $m)) {
            $cta = trim(preg_replace('/\s+/', ' ', strip_tags($m[1])) ?? '');
            if ($cta !== '') {
                $hero['cta_text'] = $cta;
            }
        }

        $badges = [];
        if (preg_match_all(
            '/<(?:div|li)\b[^>]*class=["\'][^"\']*\bhero-chip\b[^"\']*["\'][^>]*>\s*<(?:b|strong)>(.*?)<\/(?:b|strong)>\s*<span\b[^>]*>(.*?)<\/span>/is',
            $chunk,
            $rows,
            PREG_SET_ORDER
        )) {
            foreach ($rows as $row) {
                $num = trim(strip_tags($row[1]));
                $label = trim(strip_tags($row[2]));
                if ($num !== '' || $label !== '') {
                    $badges[] = ['num' => $num, 'label' => $label];
                }
            }
        }
        if ($badges !== []) {
            $hero['badges'] = $badges;
        }

        // Explicitly do not keep theme eyebrow
        unset($hero['eyebrow']);

        return $hero;
    }

    private function stripFinalCta(string $html): string
    {
        // Comment-anchored cut avoids PCRE backtrack on multi-MB base64 CTA backgrounds
        if (preg_match('/<!--\s*FINAL CTA\s*-->/i', $html, $m, PREG_OFFSET_CAPTURE)) {
            $start = (int) $m[0][1];
            $after = substr($html, $start);
            if (preg_match('/^<!--\s*FINAL CTA\s*-->\s*<section\b[^>]*>/i', $after, $open)) {
                $rest = substr($after, strlen($open[0]));
                $endPos = stripos($rest, '</section>');
                if ($endPos !== false) {
                    $endPos += strlen('</section>');
                    while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                        $endPos++;
                    }

                    return substr($html, 0, $start).substr($rest, $endPos);
                }
            }
        }

        // Class-based fallback (cta-final / cta-sec)
        foreach (['cta-final', 'cta-sec'] as $cls) {
            if (preg_match('/<section\b[^>]*\b'.preg_quote($cls, '/').'\b[^>]*>/i', $html, $m, PREG_OFFSET_CAPTURE)) {
                $start = (int) $m[0][1];
                $openLen = strlen($m[0][0]);
                $rest = substr($html, $start + $openLen);
                $endPos = stripos($rest, '</section>');
                if ($endPos !== false) {
                    $endPos += strlen('</section>');
                    while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                        $endPos++;
                    }

                    return substr($html, 0, $start).substr($rest, $endPos);
                }
            }
        }

        // Heading fallback
        $needle = 'READY WHEN YOU ARE';
        $pos = stripos($html, $needle);
        if ($pos !== false) {
            $before = substr($html, 0, $pos);
            $secStart = strripos($before, '<section');
            if ($secStart !== false) {
                $rest = substr($html, $pos);
                $endPos = stripos($rest, '</section>');
                if ($endPos !== false) {
                    $endPos += strlen('</section>');
                    while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                        $endPos++;
                    }

                    return substr($html, 0, $secStart).substr($rest, $endPos);
                }
            }
        }

        return $html;
    }

    private function stripContact(string $html): string
    {
        if (preg_match('/<section\b[^>]*\bid=["\']contact["\'][^>]*>/i', $html, $m, PREG_OFFSET_CAPTURE)) {
            $start = (int) $m[0][1];
            $openLen = strlen($m[0][0]);
            $rest = substr($html, $start + $openLen);
            $endPos = stripos($rest, '</section>');
            if ($endPos !== false) {
                $endPos += strlen('</section>');
                while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                    $endPos++;
                }

                return substr($html, 0, $start).substr($rest, $endPos);
            }
        }

        return $html;
    }

    private function extractHeroImageFromTheme(string $rawThemeHtml, string $mediaTo): string
    {
        // Prefer first large PNG/webp data URI near hero alt text
        if (preg_match(
            '/alt=["\']GEO services[^"\']*["\'][^>]*>/i',
            $rawThemeHtml,
            $m,
            PREG_OFFSET_CAPTURE
        )) {
            $before = substr($rawThemeHtml, max(0, $m[0][1] - 200), 200);
            if (preg_match('/src=["\'](data:image\/[^"\']+)["\']/i', $before.$m[0][0], $src)) {
                return ThemeHtmlImporter::writeDataUriPublic($src[1], 'geo-services-ai-search-visibility-hero-kodrank.webp', $mediaTo);
            }
        }

        return '';
    }
}
