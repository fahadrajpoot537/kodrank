<?php

namespace App\Support;

use App\Models\CmsSection;
use Illuminate\Support\Str;

class BlogAuthors
{
    /**
     * Authors from CMS (Blog authors section), falling back to the seeded team.
     *
     * @return array<string, array{name:string, role:string, linkedin:string, image:string, bio:string}>
     */
    public static function all(): array
    {
        static $cached = null;
        if ($cached !== null) {
            return $cached;
        }

        $fromCms = [];
        $section = class_exists(CmsSection::class)
            ? CmsSection::query()->where('key', 'blog_authors')->first()
            : null;
        $rows = is_array($section?->data['authors'] ?? null) ? $section->data['authors'] : [];

        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }
            $name = trim((string) ($row['name'] ?? ''));
            if ($name === '') {
                continue;
            }
            $key = Str::slug((string) ($row['key'] ?? '')) ?: Str::slug($name);
            if ($key === '') {
                continue;
            }
            $fromCms[$key] = [
                'name' => $name,
                'role' => (string) ($row['role'] ?? ''),
                'linkedin' => (string) ($row['linkedin'] ?? ''),
                'image' => (string) ($row['image'] ?? ''),
                'bio' => (string) ($row['bio'] ?? ''),
            ];
        }

        if ($fromCms !== []) {
            return $cached = $fromCms;
        }

        $fallback = [];
        foreach (CmsPageDefaults::defaultAuthors() as $author) {
            $fallback[$author['key']] = [
                'name' => $author['name'],
                'role' => $author['role'],
                'linkedin' => $author['linkedin'],
                'image' => $author['image'],
                'bio' => $author['bio'],
            ];
        }

        return $cached = $fallback;
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
            return self::all()['hidayatul-haq'] ?? null;
        }

        if (stripos($name, 'Fahad') !== false) {
            return self::all()['fahad-bin-khalid'] ?? null;
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

        if (stripos($name, 'Hidayat') !== false && isset(self::all()['hidayatul-haq'])) {
            return 'hidayatul-haq';
        }

        if (stripos($name, 'Fahad') !== false && isset(self::all()['fahad-bin-khalid'])) {
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

        return $path !== '' && is_file(public_path($path)) ? $path : null;
    }
}
