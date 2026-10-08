<?php

namespace App\Support;

final class ServiceHeroDesign
{
    /**
     * Service pages that share the Technical SEO hero layout.
     * Copy and images stay on each page; only the design is shared.
     *
     * @return list<string>
     */
    public static function slugs(): array
    {
        return [
            'digital-marketing-services',
            'shopify-seo-services',
            'on-page-seo-services',
            'white-label-seo-services',
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
            'wordpress-development-services',
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
}
