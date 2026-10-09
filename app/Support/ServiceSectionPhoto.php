<?php

namespace App\Support;

use App\Models\ServicePage;

/**
 * Admin "results background image" paints the dark section photo on each service page.
 * An empty value keeps the image already set in that page's CSS.
 */
class ServiceSectionPhoto
{
    /**
     * section = CMS key that owns the upload.
     * mode = ink (gradient + photo) or layer (photo on the inner .stats-bg only).
     *
     * @var array<string, array{section: string, mode: string, selectors: list<string>}>
     */
    private const TARGETS = [
        'wordpress-seo-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-wpseo.page-service .wpseo-theme-page.theme-html-root #results.sec-ink',
            ],
        ],
        'guest-posting-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-gpseo.page-service .gp-theme-page.theme-html-root #vetting.sec-ink',
            ],
        ],
        'monthly-seo-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-monthly.page-service .monthly-theme-page.theme-html-root #process.sec-ink',
                'html body.page-monthly.page-service .monthly-theme-page.theme-html-root section#process',
            ],
        ],
        'shopify-seo-services' => [
            'section' => 'process',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-shopifyseo.page-service #process.sec-ink',
            ],
        ],
        'saas-seo-services' => [
            'section' => 'body',
            'mode' => 'layer',
            'selectors' => [
                'html body.page-saasseo.page-service .saasseo-theme-page.theme-html-root #results .stats-bg',
                'html body.page-saasseo.page-service .saasseo-theme-page.theme-html-root #results #statsBg',
            ],
        ],
        'on-page-seo-services' => [
            'section' => 'body',
            'mode' => 'layer',
            'selectors' => [
                'html body.page-onpage.page-service .onpage-theme-page.theme-html-root #results .stats-bg',
                'html body.page-onpage.page-service .onpage-theme-page.theme-html-root #results.stats-sec',
            ],
        ],
        'healthcare-seo-services' => [
            'section' => 'body',
            'mode' => 'layer',
            'selectors' => [
                'html body.page-hcseo.page-service .hc-theme-page.theme-html-root #results.results-bg::before',
            ],
        ],
        'real-estate-seo-services' => [
            'section' => 'body',
            'mode' => 'veil',
            'selectors' => [
                'html body.page-reseo.page-service .re-theme-page.theme-html-root #results.stats-bg::before',
            ],
        ],
        'ecommerce-seo-services' => [
            'section' => 'body',
            'mode' => 'wash',
            'selectors' => [
                'html body.page-ecomseo.page-service .ecom-theme-page.theme-html-root #results::before',
            ],
        ],
        'restaurant-seo-services' => [
            'section' => 'body',
            'mode' => 'card',
            'selectors' => [
                'html body.page-restseo.page-service .rest-theme-page.theme-html-root #results .results',
            ],
        ],
        'b2b-seo-services' => [
            'section' => 'body',
            'mode' => 'fade',
            'selectors' => [
                'html body.page-b2bseo.page-service .b2b-theme-page.theme-html-root section.stats-sec',
            ],
        ],
        'cms-development-services' => [
            'section' => 'body',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-cms.page-service .cms-theme-page.theme-html-root section.numbers::before',
            ],
        ],
        'saas-software-development-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-saas.page-service .saas-theme-page.theme-html-root #why.sec-ink',
            ],
        ],
        'shopify-development-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-shopify.page-service .shopify-theme-page.theme-html-root #why.sec-ink',
            ],
        ],
        'ai-chatbot-development-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-aibot.page-service .aibot-theme-page.theme-html-root #why',
                'html body.page-aibot.page-service .aibot-theme-page.theme-html-root .sec-stats',
            ],
        ],
        'web-design-and-development-services' => [
            'section' => 'body',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-webdesign.page-service .webdesign-theme-page.theme-html-root section.sec-included-bg::before',
            ],
        ],
        'website-redesign-services' => [
            'section' => 'body',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-redesign.page-service .redesign-theme-page.theme-html-root section.stats-sec .bg-img',
            ],
        ],
        'wordpress-development-services' => [
            'section' => 'body',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-wpdev.page-service .wpdev-theme-page.theme-html-root section.stats-bg::before',
            ],
            'photos' => [
                'why_background_image' => [
                    'mode' => 'cover',
                    'selectors' => [
                        'html body.page-wpdev.page-service .wpdev-theme-page.theme-html-root section.why-bg::before',
                    ],
                ],
            ],
        ],
        'electrician-website-design-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-elec.page-service .elec-theme-page.theme-html-root section.sec-ink:not(#seo)',
            ],
        ],
        'digital-marketing-services' => [
            'section' => 'stats',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-dm.page-service #results.stats-bg',
                'html body.page-dm.page-service section.stats-bg',
            ],
        ],
        'white-label-seo-services' => [
            'section' => 'why',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-wlseo.page-service #why.sec-ink',
            ],
        ],
        'aeo-services' => [
            'section' => 'body',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-aeo.page-service .aeo-theme-page.theme-html-root > section.sec-ink::before',
            ],
        ],
        'geo-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-geo.page-service .geo-theme-page.theme-html-root section.stats-sec',
            ],
        ],
        'technical-seo-services' => [
            'section' => 'body',
            'mode' => 'ink',
            'selectors' => [
                'html body.page-techseo.page-service .techseo-theme-page.theme-html-root #services.sec-services-bg',
            ],
        ],
        'off-page-seo-services' => [
            'section' => 'body',
            'mode' => 'cover',
            'selectors' => [
                'html body.page-offpage.page-service .offpage-theme-page.theme-html-root #work.stats-sec .sbg',
            ],
        ],
    ];

    public static function sectionKey(string $slug): string
    {
        return self::TARGETS[$slug]['section'] ?? 'body';
    }

    /**
     * @return list<string>
     */
    public static function fieldKeys(string $slug): array
    {
        $keys = ['results_background_image'];
        foreach (self::TARGETS[$slug]['photos'] ?? [] as $key => $photo) {
            $keys[] = (string) $key;
        }

        return $keys;
    }

    public static function ownsField(string $slug, string $sectionKey): bool
    {
        if (in_array($sectionKey, ['body', 'stats', 'results'], true)) {
            return true;
        }

        return $sectionKey === self::sectionKey($slug);
    }

    public static function url(ServicePage $page): string
    {
        $slug = (string) $page->slug;
        $order = array_values(array_unique(array_filter([
            self::sectionKey($slug),
            'body',
            'stats',
            'results',
            'process',
            'why',
        ])));

        $sections = $page->relationLoaded('sections') ? $page->sections : $page->sections()->get();
        $byKey = [];
        foreach ($sections as $section) {
            $byKey[$section->key] = is_array($section->data) ? $section->data : [];
        }

        foreach ($order as $key) {
            $value = trim((string) ($byKey[$key]['results_background_image'] ?? ''));
            if ($value !== '') {
                return $value;
            }
        }

        return '';
    }

    /**
     * Swap a theme photo that is an <img>, not a CSS background.
     * The stats image is often a multi-megabyte data URI, which breaks a
     * section-wide regular expression on PHP's backtrack limit.
     */
    public static function swapInlinePhoto(string $html, string $url): string
    {
        if ($html === '' || $url === '') {
            return $html;
        }

        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $html = self::swapSrcAfter($html, 'stats-sec', 'bg-sec-img', $safe);
        $html = self::swapSrcAfter($html, 'why-bg', null, $safe);
        $html = self::swapBackgroundAfter($html, 'id="work"', 'class="sbg"', $safe);

        return $html;
    }

    private static function swapBackgroundAfter(string $html, string $startMarker, string $imgMarker, string $url): string
    {
        $from = stripos($html, $startMarker);
        if ($from === false) {
            return $html;
        }

        $regionEnd = stripos($html, '</section>', $from);
        $marker = stripos($html, $imgMarker, $from);
        if ($marker === false || ($regionEnd !== false && $marker > $regionEnd)) {
            return $html;
        }

        $prop = stripos($html, 'background-image', $marker);
        if ($prop === false || $prop > $marker + 200) {
            return $html;
        }

        $urlPos = stripos($html, 'url(', $prop);
        if ($urlPos === false || $urlPos > $prop + 40) {
            return $html;
        }

        $open = $urlPos + 4;
        $quote = $html[$open] ?? '';
        if ($quote === '"' || $quote === "'") {
            $valueStart = $open + 1;
            $valueEnd = strpos($html, $quote, $valueStart);
            if ($valueEnd === false) {
                return $html;
            }

            return substr($html, 0, $valueStart).$url.substr($html, $valueEnd);
        }

        $valueEnd = strpos($html, ')', $open);
        if ($valueEnd === false) {
            return $html;
        }

        return substr($html, 0, $open).$url.substr($html, $valueEnd);
    }

    private static function swapSrcAfter(string $html, string $startMarker, ?string $imgMarker, string $url): string
    {
        $from = stripos($html, $startMarker);
        if ($from === false) {
            return $html;
        }

        $regionEnd = stripos($html, '</section>', $from);
        $searchFrom = $from;
        if ($imgMarker !== null) {
            $marker = stripos($html, $imgMarker, $from);
            if ($marker === false || ($regionEnd !== false && $marker > $regionEnd)) {
                return $html;
            }
            $searchFrom = $marker;
        }

        $img = stripos($html, '<img', $searchFrom);
        if ($img === false || ($regionEnd !== false && $img > $regionEnd) || $img > $searchFrom + 800) {
            return $html;
        }

        $src = stripos($html, 'src=', $img);
        if ($src === false || $src > $img + 400) {
            return $html;
        }

        $quote = $html[$src + 4] ?? '';
        if ($quote !== '"' && $quote !== "'") {
            return $html;
        }

        $valueStart = $src + 5;
        $valueEnd = strpos($html, $quote, $valueStart);
        if ($valueEnd === false) {
            return $html;
        }

        return substr($html, 0, $valueStart).$url.substr($html, $valueEnd);
    }

    public static function css(ServicePage $page): string
    {
        $slug = (string) $page->slug;
        $target = self::TARGETS[$slug] ?? null;
        if ($target === null) {
            return '';
        }

        $chunks = [];
        $primary = self::url($page);
        if ($primary !== '') {
            $chunks[] = self::paint($target['mode'], $target['selectors'], $primary);
        }

        $sections = $page->relationLoaded('sections') ? $page->sections : $page->sections()->get();
        $data = [];
        foreach ($sections as $section) {
            if ($section->key === self::sectionKey($slug)) {
                $data = is_array($section->data) ? $section->data : [];
                break;
            }
        }
        foreach ($target['photos'] ?? [] as $key => $photo) {
            $value = trim((string) ($data[$key] ?? ''));
            if ($value === '') {
                continue;
            }
            $chunks[] = self::paint((string) ($photo['mode'] ?? 'cover'), $photo['selectors'], $value);
        }

        return implode("\n", $chunks);
    }

    /**
     * @param  list<string>  $selectors
     */
    private static function paint(string $mode, array $selectors, string $path): string
    {
        $url = e(asset(ltrim($path, '/')));
        $selectorList = implode(",\n", $selectors);

        if ($mode === 'layer' || $mode === 'cover') {
            return <<<CSS
{$selectorList} {
  background-image: url("{$url}") !important;
  background-size: cover !important;
  background-position: center right !important;
  background-repeat: no-repeat !important;
}
CSS;
        }

        if ($mode === 'fade') {
            return <<<CSS
{$selectorList} {
  background-color: #061019 !important;
  background-image:
    linear-gradient(180deg, rgba(10, 26, 34, 0.5), var(--ink, #0a1a22) 82%),
    url("{$url}") !important;
  background-size: cover !important;
  background-position: center !important;
  background-repeat: no-repeat !important;
}
CSS;
        }

        if ($mode === 'wash') {
            return <<<CSS
{$selectorList} {
  background-color: var(--ink, #0a1a22) !important;
  background-image:
    linear-gradient(90deg, var(--ink, #0a1a22) 0%, rgba(10, 26, 34, 0.94) 32%, rgba(10, 26, 34, 0.55) 62%, rgba(10, 26, 34, 0.35) 100%),
    radial-gradient(900px 500px at 88% 40%, rgba(244, 122, 31, 0.10), transparent 60%),
    url("{$url}") !important;
  background-size: cover !important;
  background-position: center, center, right center !important;
  background-repeat: no-repeat !important;
}
CSS;
        }

        if ($mode === 'card') {
            return <<<CSS
{$selectorList} {
  background-color: var(--ink, #0a1a22) !important;
  background-image:
    linear-gradient(90deg, var(--ink, #0a1a22) 0%, var(--ink, #0a1a22) 30%, rgba(10, 26, 34, 0.82) 55%, rgba(10, 26, 34, 0.42) 100%),
    url("{$url}") !important;
  background-size: cover !important;
  background-position: center, right center !important;
  background-repeat: no-repeat !important;
}
CSS;
        }

        if ($mode === 'veil') {
            return <<<CSS
{$selectorList} {
  background-image:
    linear-gradient(rgba(10, 26, 34, 0.5), rgba(10, 26, 34, 0.5)),
    linear-gradient(100deg, rgba(10, 26, 34, 0.94) 0%, rgba(10, 26, 34, 0.82) 46%, rgba(10, 26, 34, 0.4) 78%, rgba(10, 26, 34, 0.34) 100%),
    url("{$url}") !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
}
CSS;
        }

        return <<<CSS
{$selectorList} {
  background-color: var(--ink, #0a1a22) !important;
  background-image:
    linear-gradient(90deg, rgba(10, 26, 34, 0.94) 0%, rgba(10, 26, 34, 0.78) 42%, rgba(10, 26, 34, 0.4) 100%),
    linear-gradient(180deg, rgba(10, 26, 34, 0.28) 0%, rgba(10, 26, 34, 0.08) 48%, rgba(10, 26, 34, 0.4) 100%),
    url("{$url}") !important;
  background-size: cover !important;
  background-position: center, center, right center !important;
  background-repeat: no-repeat !important;
}
CSS;
    }
}
