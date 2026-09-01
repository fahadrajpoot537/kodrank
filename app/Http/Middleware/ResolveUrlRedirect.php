<?php

namespace App\Http\Middleware;

use App\Support\UrlRedirector;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveUrlRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') && ! $request->isMethod('HEAD')) {
            return $next($request);
        }

        if ($request->is('admin') || $request->is('admin/*') || $request->is('up')) {
            return $next($request);
        }

        $path = UrlRedirector::normalizePath('/'.$request->path());
        $redirect = UrlRedirector::find($path);

        if (! $redirect) {
            return $next($request);
        }

        if (UrlRedirector::pathIsOccupied($path)) {
            return $next($request);
        }

        $target = $redirect->to_path;
        $query = $request->getQueryString();
        if (is_string($query) && $query !== '') {
            $target .= (str_contains($target, '?') ? '&' : '?').$query;
        }

        return redirect($target, (int) ($redirect->status_code ?: 301));
    }
}
