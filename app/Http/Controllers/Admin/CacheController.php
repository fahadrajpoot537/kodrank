<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsSection;
use App\Models\ServicePage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function clear(): RedirectResponse
    {
        $this->runClear();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'All application caches cleared successfully.');
    }

    /**
     * Public one-click clear: /clear-cache?key=YOUR_CACHE_CLEAR_KEY
     */
    public function clearPublic(Request $request): Response|RedirectResponse
    {
        $expected = (string) config('app.cache_clear_key', env('CACHE_CLEAR_KEY', ''));
        $given = (string) $request->query('key', '');

        if ($expected === '' || ! hash_equals($expected, $given)) {
            abort(403, 'Invalid or missing cache clear key.');
        }

        $this->runClear();

        if ($request->expectsJson()) {
            return response('OK — caches cleared.', 200);
        }

        return response(
            '<!doctype html><html><head><meta charset="utf-8"><title>Cache cleared</title></head>'.
            '<body style="font-family:system-ui;padding:40px;line-height:1.5">'.
            '<h1>Cache cleared</h1>'.
            '<p>Application, config, route, view, and CMS caches were cleared.</p>'.
            '<p><a href="'.e(url('/')).'">← Back to site</a></p>'.
            '</body></html>',
            200
        )->header('Content-Type', 'text/html; charset=UTF-8');
    }

    private function runClear(): void
    {
        Artisan::call('optimize:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');

        Cache::flush();
        CmsSection::forgetCache();
        ServicePage::forgetNavCache();

        foreach (ServicePage::query()->pluck('slug') as $slug) {
            ServicePage::forgetCache((string) $slug);
        }
    }
}
