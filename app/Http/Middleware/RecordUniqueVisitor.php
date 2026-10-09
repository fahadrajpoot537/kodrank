<?php

namespace App\Http\Middleware;

use App\Models\VisitorDay;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/**
 * Counts one unique visitor per browser per day on public pages.
 * Admin screens and known crawlers are skipped.
 */
class RecordUniqueVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldCount($request)) {
            return $response;
        }

        if (! Schema::hasTable('visitor_days')) {
            return $response;
        }

        $key = (string) $request->cookie('kr_vid', '');
        $isNew = ! preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $key);
        if ($isNew) {
            $key = (string) Str::uuid();
        }

        try {
            VisitorDay::query()->insertOrIgnore([
                'visitor_key' => $key,
                'visited_on' => now()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable) {
            return $response;
        }

        if ($isNew && method_exists($response, 'withCookie')) {
            $response->withCookie(cookie(
                'kr_vid',
                $key,
                60 * 24 * 400,
                '/',
                null,
                $request->isSecure(),
                true,
                false,
                'Lax'
            ));
        }

        return $response;
    }

    private function shouldCount(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if ($request->is('admin', 'admin/*', 'up', 'clear-cache', 'sitemap.xml', 'image-sitemap.xml', 'robots.txt')) {
            return false;
        }

        $ua = strtolower((string) $request->userAgent());
        if ($ua === '' || preg_match('/bot|crawl|spider|slurp|preview|wget|curl|headless|facebookexternalhit|embedly|quora|pinterest|whatsapp|telegrambot/i', $ua)) {
            return false;
        }

        return true;
    }
}
