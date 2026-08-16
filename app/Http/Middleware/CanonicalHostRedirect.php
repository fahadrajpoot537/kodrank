<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Single 301 to https://kodrank.com for production hosts only.
 * Local / staging hosts (localhost, 127.0.0.1, etc.) are never redirected.
 */
class CanonicalHostRedirect
{
    private const CANONICAL_HOST = 'kodrank.com';

    /** @var list<string> */
    private const MANAGED_HOSTS = ['kodrank.com', 'www.kodrank.com'];

    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost());

        if (! in_array($host, self::MANAGED_HOSTS, true)) {
            return $next($request);
        }

        $requestUri = $request->getRequestUri();
        $rawPath = parse_url($requestUri, PHP_URL_PATH);
        $query = parse_url($requestUri, PHP_URL_QUERY);

        $rawPath = is_string($rawPath) && $rawPath !== '' ? $rawPath : '/';
        $path = $this->canonicalizePath($rawPath);

        // Homepage only: drop query string. Other paths keep query (search/filters/APIs/forms).
        $isHome = $path === '/';
        $queryPart = (! $isHome && is_string($query) && $query !== '') ? '?'.$query : '';

        $target = 'https://'.self::CANONICAL_HOST.$path.$queryPart;

        $currentQuery = is_string($query) && $query !== '' ? '?'.$query : '';
        $current = ($request->secure() ? 'https' : 'http').'://'.$host.$rawPath.$currentQuery;

        if (strcasecmp($current, $target) !== 0) {
            return redirect()->away($target, 301);
        }

        return $next($request);
    }

    private function canonicalizePath(string $path): string
    {
        if (preg_match('#^/public(?:/(.*))?$#i', $path, $m)) {
            $path = '/'.($m[1] ?? '');
        }

        if (preg_match('#^/index\.php(?:/(.*))?$#i', $path, $m)) {
            $path = '/'.($m[1] ?? '');
        }

        $path = '/'.ltrim($path, '/');
        $path = preg_replace('#/+#', '/', $path) ?: '/';

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return $path === '' ? '/' : $path;
    }
}
