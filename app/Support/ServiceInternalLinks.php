<?php

namespace App\Support;

/**
 * Cross-link related KodRank service mentions in theme HTML / CMS copy.
 */
class ServiceInternalLinks
{
    /**
     * Longest phrases first so "On-Page SEO Services" wins over "On-Page SEO".
     *
     * @return array<string, string> phrase => path
     */
    public static function phraseMap(): array
    {
        return array_merge(self::seoPhraseMap(), self::devPhraseMap());
    }

    /**
     * @return array<string, string>
     */
    public static function seoPhraseMap(): array
    {
        return [
            'Answer Engine Optimization (AEO)' => '/aeo-services',
            'Generative Engine Optimization (GEO)' => '/geo-services',
            'Digital Marketing Services' => '/digital-marketing-services',
            'On-Page SEO Services' => '/on-page-seo-services',
            'Off-Page SEO Services' => '/off-page-seo-services',
            'Technical SEO Services' => '/technical-seo-services',
            'Answer Engine Optimization' => '/aeo-services',
            'Generative Engine Optimization' => '/geo-services',
            'AEO Services' => '/aeo-services',
            'GEO Services' => '/geo-services',
            'On-Page SEO' => '/on-page-seo-services',
            'Off-Page SEO' => '/off-page-seo-services',
            'Technical SEO' => '/technical-seo-services',
            'on-page SEO' => '/on-page-seo-services',
            'off-page SEO' => '/off-page-seo-services',
            'technical SEO' => '/technical-seo-services',
            'digital marketing services' => '/digital-marketing-services',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function devPhraseMap(): array
    {
        return [
            'Web Design and Development Services' => '/web-design-and-development-services',
            'WordPress Development Services' => '/wordpress-development-services',
            'Shopify Development Services' => '/shopify-development-services',
            'AI Chatbot Development Services' => '/ai-chatbot-development-services',
            'CMS Development Services' => '/cms-development-services',
            'Website Redesign Services' => '/website-redesign-services',
            'Electrician Website Design Services' => '/electrician-website-design-services',
            'SaaS Software Development Services' => '/saas-software-development-services',
            'WordPress Development' => '/wordpress-development-services',
            'Shopify Development' => '/shopify-development-services',
            'Website Redesign' => '/website-redesign-services',
            'CMS Development' => '/cms-development-services',
        ];
    }

    /**
     * @return list<string>
     */
    public static function developmentSlugs(): array
    {
        return [
            'web-design-and-development-services',
            'wordpress-development-services',
            'shopify-development-services',
            'ai-chatbot-development-services',
            'cms-development-services',
            'website-redesign-services',
            'electrician-website-design-services',
            'saas-software-development-services',
        ];
    }

    public static function isDevelopmentSlug(?string $slug): bool
    {
        return in_array(trim((string) $slug, '/'), self::developmentSlugs(), true);
    }

    /**
     * Card / CTA title → service path (DM services grid, etc.).
     *
     * @return array<string, string>
     */
    public static function cardUrlMap(): array
    {
        return [
            'On-Page SEO' => '/on-page-seo-services',
            'Off-Page SEO' => '/off-page-seo-services',
            'Technical SEO' => '/technical-seo-services',
            'Answer Engine Optimization (AEO)' => '/aeo-services',
            'Generative Engine Optimization (GEO)' => '/geo-services',
            'Monthly SEO Services' => '/monthly-seo-services',
            'B2B SEO Services' => '/b2b-seo-services',
            'SaaS SEO Services' => '/saas-seo-services',
            'Ecommerce SEO Services' => '/ecommerce-seo-services',
            'E-commerce SEO Services' => '/ecommerce-seo-services',
            'WordPress SEO Services' => '/wordpress-seo-services',
            'Shopify SEO Services' => '/shopify-seo-services',
            'White Label SEO Services' => '/white-label-seo-services',
        ];
    }

    public static function normalizeUrl(?string $url): string
    {
        $url = trim((string) $url);
        if ($url === '' || $url === '#') {
            return '#contact';
        }
        if (
            str_starts_with($url, 'http://')
            || str_starts_with($url, 'https://')
            || str_starts_with($url, 'mailto:')
            || str_starts_with($url, 'tel:')
            || str_starts_with($url, '#')
        ) {
            return $url;
        }
        if (str_starts_with($url, '/') && $url !== '/') {
            return rtrim($url, '/') ?: '/';
        }

        return $url;
    }

    public static function urlForCard(string $title, ?string $fallback = '#contact'): string
    {
        $map = self::cardUrlMap();
        if (isset($map[$title])) {
            return $map[$title];
        }

        return self::normalizeUrl($fallback);
    }

    /**
     * Wrap the first plain-text occurrence of each related service phrase.
     * Skips current page targets, existing anchors, headings, scripts, and styles.
     */
    public static function linkifyHtml(string $html, ?string $currentSlug = null): string
    {
        if ($html === '' || ! str_contains($html, '<')) {
            return $html;
        }

        $currentSlug = trim((string) $currentSlug, '/');
        $phraseSource = self::isDevelopmentSlug($currentSlug)
            ? self::devPhraseMap()
            : self::seoPhraseMap();
        $candidates = [];
        foreach ($phraseSource as $phrase => $path) {
            $slug = trim($path, '/');
            if ($currentSlug !== '' && strcasecmp($slug, $currentSlug) === 0) {
                continue;
            }
            if (isset($candidates[$path])) {
                continue;
            }
            if (stripos($html, $phrase) === false) {
                continue;
            }
            $candidates[$phrase] = $path;
        }
        if ($candidates === []) {
            return $html;
        }

        $parts = preg_split('/(<[^>]+>)/', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        if ($parts === false || $parts === []) {
            return $html;
        }

        $inAnchor = 0;
        $inSkip = 0;
        $inNoLink = 0;
        $linkedPaths = [];

        foreach ($parts as $i => $part) {
            if ($part === '' || $part[0] === '<') {
                if (preg_match('/^<(script|style|noscript)\b/i', $part)) {
                    $inSkip++;
                } elseif (preg_match('/^<\/(script|style|noscript)\b/i', $part)) {
                    $inSkip = max(0, $inSkip - 1);
                } elseif (preg_match('/^<a\b/i', $part)) {
                    $inAnchor++;
                } elseif (preg_match('/^<\/a\b/i', $part)) {
                    $inAnchor = max(0, $inAnchor - 1);
                } elseif (preg_match('/^<(h[1-6]|summary|label|button|figcaption|title)\b/i', $part)) {
                    $inNoLink++;
                } elseif (preg_match('/^<\/(h[1-6]|summary|label|button|figcaption|title)\b/i', $part)) {
                    $inNoLink = max(0, $inNoLink - 1);
                }
                continue;
            }

            if ($inSkip > 0 || $inAnchor > 0 || $inNoLink > 0) {
                continue;
            }

            foreach ($candidates as $phrase => $path) {
                if (isset($linkedPaths[$path])) {
                    continue;
                }

                $quoted = preg_quote($phrase, '/');
                $next = preg_replace(
                    '/\b'.$quoted.'\b/iu',
                    '<a href="'.$path.'">$0</a>',
                    $part,
                    1,
                    $count
                );
                if (is_string($next) && $count > 0) {
                    $parts[$i] = $next;
                    $part = $next;
                    $linkedPaths[$path] = true;
                }
            }
        }

        return implode('', $parts);
    }
}