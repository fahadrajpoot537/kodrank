<?php

namespace App\Support;

/**
 * Pages that consume the WordPress Development Services design system.
 * The WP page itself is the template and is not in this list.
 */
class WpRefDesign
{
    /**
     * @return list<string>
     */
    public static function slugs(): array
    {
        return [
            'digital-marketing-services',
            'on-page-seo-services',
            'off-page-seo-services',
            'technical-seo-services',
            'aeo-services',
            'geo-services',
            'monthly-seo-services',
            'saas-seo-services',
            'b2b-seo-services',
            'ecommerce-seo-services',
            'wordpress-seo-services',
            'guest-posting-services',
            'restaurant-seo-services',
            'healthcare-seo-services',
            'real-estate-seo-services',
            'web-design-and-development-services',
            'shopify-development-services',
            'ai-chatbot-development-services',
            'cms-development-services',
            'website-redesign-services',
            'electrician-website-design-services',
            'saas-software-development-services',
        ];
    }

    public static function appliesTo(?string $slug): bool
    {
        return in_array((string) $slug, self::slugs(), true);
    }

    /**
     * SEO / marketing pages that share the Digital Marketing motion system
     * (compact hero, mobile carousels, tablet stacks).
     *
     * @return list<string>
     */
    public static function seoMotionSlugs(): array
    {
        return [
            'digital-marketing-services',
            'on-page-seo-services',
            'off-page-seo-services',
            'technical-seo-services',
            'aeo-services',
            'geo-services',
            'monthly-seo-services',
            'saas-seo-services',
            'b2b-seo-services',
            'ecommerce-seo-services',
            'wordpress-seo-services',
            'guest-posting-services',
            'restaurant-seo-services',
            'healthcare-seo-services',
            'real-estate-seo-services',
        ];
    }

    public static function usesSeoMotion(?string $slug): bool
    {
        return in_array((string) $slug, self::seoMotionSlugs(), true);
    }
}
