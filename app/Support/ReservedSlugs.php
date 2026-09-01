<?php

namespace App\Support;

class ReservedSlugs
{
    /**
     * Paths that must not be used as a service-page slug.
     *
     * @return list<string>
     */
    public static function all(): array
    {
        return [
            'admin',
            'blog',
            'blogs',
            'contact',
            'services',
            'results',
            'login',
            'logout',
            'sitemap',
            'up',
            'storage',
            'media',
            'css',
            'js',
            'vendor',
            'clear-cache',
        ];
    }

    public static function contains(string $slug): bool
    {
        return in_array(strtolower(trim($slug)), self::all(), true);
    }
}
