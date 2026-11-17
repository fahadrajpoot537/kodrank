<?php

namespace App\Http\Middleware;

use App\Support\HtmlNofollow;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Blog and page HTML stored in the CMS includes rel="nofollow" on internal links.
 * Strip that token on the way out. External links and /admin links are left alone.
 */
class StripInternalNofollow
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $type = strtolower((string) $response->headers->get('Content-Type', ''));
        if ($type !== '' && ! str_contains($type, 'html')) {
            return $response;
        }

        $html = $response->getContent();
        if (! is_string($html) || stripos($html, 'nofollow') === false) {
            return $response;
        }

        $hosts = HtmlNofollow::defaultHosts();
        $hosts[] = $request->getHost();

        $clean = HtmlNofollow::stripInternal($html, $hosts);
        if ($clean !== $html) {
            $response->setContent($clean);
        }

        return $response;
    }
}
