<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust proxies so HTTPS is detected correctly behind Cloudflare / load balancers
        $middleware->trustProxies(at: '*');

        // Production-only canonical 301s (skipped for localhost / other hosts)
        $middleware->prepend(\App\Http\Middleware\CanonicalHostRedirect::class);

        // Security headers when Apache has not already set them (e.g. artisan serve)
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        $middleware->append(\App\Http\Middleware\ResolveUrlRedirect::class);

        $middleware->redirectGuestsTo('/admin/login');
        $middleware->redirectUsersTo('/admin');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
