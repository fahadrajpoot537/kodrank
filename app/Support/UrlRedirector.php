<?php

namespace App\Support;

use App\Models\BlogPost;
use App\Models\ServicePage;
use App\Models\UrlRedirect;
use Illuminate\Support\Facades\Schema;

class UrlRedirector
{
    public static function normalizePath(string $path): string
    {
        $path = '/'.ltrim(trim($path), '/');
        $path = preg_replace('#/+#', '/', $path) ?: '/';
        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return $path === '' ? '/' : $path;
    }

    public static function remember(string $fromPath, string $toPath, int $status = 301): void
    {
        if (! Schema::hasTable('url_redirects')) {
            return;
        }

        $from = self::normalizePath($fromPath);
        $to = self::normalizePath($toPath);

        if ($from === '/' || $to === '/' || $from === $to) {
            return;
        }

        UrlRedirect::query()
            ->where('to_path', $from)
            ->update(['to_path' => $to]);

        UrlRedirect::query()->where('from_path', $to)->delete();

        UrlRedirect::query()->updateOrCreate(
            ['from_path' => $from],
            ['to_path' => $to, 'status_code' => $status]
        );
    }

    public static function find(string $path): ?UrlRedirect
    {
        if (! Schema::hasTable('url_redirects')) {
            return null;
        }

        return UrlRedirect::query()
            ->where('from_path', self::normalizePath($path))
            ->first();
    }

    public static function pathIsOccupied(string $path): bool
    {
        $path = self::normalizePath($path);
        $slug = ltrim($path, '/');

        if (ReservedSlugs::contains($slug) || $path === '/') {
            return true;
        }

        if (str_starts_with($path, '/blogs/')) {
            $blogSlug = substr($path, strlen('/blogs/'));

            return $blogSlug !== '' && BlogPost::query()->where('slug', $blogSlug)->exists();
        }

        return ServicePage::query()->where('slug', $slug)->where('is_active', true)->exists();
    }
}
