<?php

namespace App\Support;

class BlogAuthors
{
    /**
     * Fixed team authors available in the blog admin.
     *
     * @return array<string, array{name:string, role:string, linkedin:string, image:string, bio:string}>
     */
    public static function all(): array
    {
        return [
            'hidayatul-haq' => [
                'name' => 'Hidayatul Haq',
                'role' => 'Founder, KodRank · SEO Strategist',
                'linkedin' => 'https://www.linkedin.com/in/hidayatul-haq',
                'image' => 'media/blog/hidayatul-haq.jpg',
                'bio' => 'Hidayat is the <strong>founder of KodRank</strong> and a <strong>top-rated SEO strategist</strong> who has delivered <strong>150+ projects across the globe</strong> — spanning technical audits, crawl-budget recovery, on-page optimization, and full-scale organic growth programs for founders, agencies, and in-house teams.',
            ],
            'fahad-bin-khalid' => [
                'name' => 'Fahad Bin Khalid',
                'role' => 'Co-founder, KodRank',
                'linkedin' => 'https://www.linkedin.com/in/fahad-bin-khalid-laravel',
                'image' => 'media/blog/fahad-bin-khalid.jpg',
                'bio' => 'Fahad is a <strong>co-founder of KodRank</strong>, building fast WordPress and custom web platforms with clean architecture, Core Web Vitals performance, and SEO-ready foundations from day one.',
            ],
        ];
    }

    public static function options(): array
    {
        $options = [];
        foreach (self::all() as $key => $author) {
            $options[$key] = $author['name'];
        }

        return $options;
    }

    public static function findByKey(?string $key): ?array
    {
        $key = trim((string) $key);

        return $key !== '' ? (self::all()[$key] ?? null) : null;
    }

    public static function findByName(?string $name): ?array
    {
        $name = trim((string) $name);
        if ($name === '') {
            return null;
        }

        foreach (self::all() as $author) {
            if (strcasecmp($author['name'], $name) === 0) {
                return $author;
            }
        }

        if (stripos($name, 'Hidayat') !== false) {
            return self::all()['hidayatul-haq'];
        }

        if (stripos($name, 'Fahad') !== false) {
            return self::all()['fahad-bin-khalid'];
        }

        return null;
    }

    public static function keyForName(?string $name): ?string
    {
        $name = trim((string) $name);
        if ($name === '') {
            return null;
        }

        foreach (self::all() as $key => $author) {
            if (strcasecmp($author['name'], $name) === 0) {
                return $key;
            }
        }

        if (stripos($name, 'Hidayat') !== false) {
            return 'hidayatul-haq';
        }

        if (stripos($name, 'Fahad') !== false) {
            return 'fahad-bin-khalid';
        }

        return null;
    }

    public static function imagePathForName(?string $name): ?string
    {
        $author = self::findByName($name);
        if (! $author) {
            return null;
        }

        $path = ltrim((string) $author['image'], '/');

        return is_file(public_path($path)) ? $path : null;
    }
}
