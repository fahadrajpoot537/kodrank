<?php

namespace App\Support;

use App\Models\ServicePage;
use Illuminate\Support\Str;

/**
 * Copy for each card on the /services grid.
 * Stored values win. Built-in lines are only the starting text.
 */
final class ServiceListingCopy
{
    /**
     * @return array<string, string>
     */
    public static function blurbs(): array
    {
        return [
            'digital-marketing-services' => 'Full-funnel campaigns across search, social, and paid — built to turn traffic into pipeline, and pipeline into revenue.',
            'monthly-seo-services' => 'Ongoing optimization that compounds. Fresh content, clean links, and technical fixes every month to climb rankings — and hold them.',
            'on-page-seo-services' => 'Titles, structure, and content tuned to search intent — so every page earns its ranking instead of hoping for one.',
            'off-page-seo-services' => 'Authority built through relevant, high-quality backlinks that move rankings — never the risky links that trigger penalties.',
            'technical-seo-services' => 'Crawlability, speed, and site health fixed at the code level — so search engines can index and reward everything you publish.',
            'saas-seo-services' => 'Growth engineered for software companies — MRR-driven keywords, product-led content, and rankings that scale with your funnel.',
            'aeo-services' => 'Answer Engine Optimization that wins featured snippets, voice results, and the direct answers people trust most.',
            'geo-services' => 'Generative Engine Optimization — content structured to be surfaced and cited by ChatGPT, Gemini, and AI overviews.',
            'b2b-seo-services' => 'Buyer-intent SEO for long sales cycles — keywords, content, and reporting tied to pipeline, not vanity traffic.',
            'ecommerce-seo-services' => 'Product and category pages that rank and sell — so organic search becomes your cheapest acquisition channel.',
            'wordpress-seo-services' => 'WordPress speed, plugins, and content fixed so your site ranks higher, loads faster, and converts more.',
            'web-design-and-development-services' => 'Fast, modern websites designed around your users and your goals — engineered to convert visitors into customers.',
            'wordpress-development-services' => 'Custom WordPress builds that are secure, scalable, and simple for your team to manage — no plugin bloat.',
            'shopify-development-services' => 'High-converting Shopify stores engineered for speed, clean UX, and sales — so more visitors reach checkout.',
            'cms-development-services' => 'Flexible content platforms that let your team publish, edit, and grow — without ever touching a line of code.',
            'website-redesign-services' => 'A rebuild that ranks and converts — a modern look and better UX, without throwing away the SEO equity you\'ve earned.',
            'ai-chatbot-development-services' => 'Custom AI assistants that answer questions, qualify leads, and convert visitors — working for you around the clock.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function tags(): array
    {
        return [
            'saas-seo-services' => 'For SaaS',
            'aeo-services' => 'AI Search',
            'geo-services' => 'AI Search',
            'b2b-seo-services' => 'B2B',
            'ecommerce-seo-services' => 'eCommerce',
            'wordpress-seo-services' => 'WordPress',
            'shopify-development-services' => 'eCommerce',
            'ai-chatbot-development-services' => 'AI Build',
        ];
    }

    public static function blurb(ServicePage $page): string
    {
        $seo = is_array($page->seo) ? $page->seo : [];
        $stored = trim((string) ($seo['listing_blurb'] ?? ''));
        if ($stored !== '') {
            return $stored;
        }

        $builtin = self::blurbs()[$page->slug] ?? '';
        if ($builtin !== '') {
            return $builtin;
        }

        $desc = self::plain((string) ($seo['seo_description'] ?? ''));
        if ($desc !== '' && ! self::isBrandOnly($desc)) {
            return Str::limit($desc, 120);
        }

        $lede = self::heroLede($page);
        if ($lede !== '') {
            return self::excerpt($lede);
        }

        return 'Explore how KodRank delivers this service end to end.';
    }

    public static function tag(ServicePage $page): string
    {
        $seo = is_array($page->seo) ? $page->seo : [];
        $stored = trim((string) ($seo['listing_tag'] ?? ''));
        if ($stored !== '') {
            return $stored;
        }

        return self::tags()[$page->slug] ?? '';
    }

    private static function heroLede(ServicePage $page): string
    {
        $hero = $page->relationLoaded('sections')
            ? $page->sections->firstWhere('key', 'hero')
            : $page->sections()->where('key', 'hero')->first();
        $data = is_array($hero->data ?? null) ? $hero->data : [];

        return self::plain((string) ($data['lede'] ?? ''));
    }

    private static function plain(string $value): string
    {
        $value = html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $value = str_replace("\u{00a0}", ' ', $value);

        return trim(preg_replace('/\s+/', ' ', $value) ?? '');
    }

    private static function excerpt(string $value): string
    {
        if (strlen($value) <= 180) {
            return $value;
        }

        $cut = substr($value, 0, 180);
        $end = strrpos($cut, '. ');
        if ($end !== false && $end > 40) {
            return trim(substr($value, 0, $end + 1));
        }

        $space = strrpos($cut, ' ');

        return trim($space ? substr($cut, 0, $space) : $cut);
    }

    private static function isBrandOnly(string $value): bool
    {
        return strcasecmp($value, 'KodRank') === 0 || strlen($value) < 12;
    }
}
