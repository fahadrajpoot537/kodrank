<?php

namespace App\Providers;

use App\Models\CmsSection;
use App\Models\ContactMessage;
use App\Models\SeoServiceInquiry;
use App\Models\ServicePage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('local')) {
            config([
                'services.recaptcha.site_key' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
                'services.recaptcha.secret_key' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
            ]);
        }

        if (! $this->app->runningInConsole()) {
            // Keep generated URLs on the current host/port (fixes 8001 vs APP_URL mismatch)
            \Illuminate\Support\Facades\URL::forceRootUrl(request()->root());
        }

        View::composer(['errors.*', 'layouts.site'], function ($view) {
            $data = $view->getData();
            if (! isset($data['c']) || ! is_array($data['c']) || $data['c'] === []) {
                if (Schema::hasTable('cms_sections')) {
                    \App\Support\CmsPageDefaults::ensure();
                    $view->with('c', CmsSection::getMap());
                } else {
                    $view->with('c', []);
                }
            }
        });

        View::composer('admin.layout', function ($view) {
            if (! Schema::hasTable('cms_sections')) {
                $view->with([
                    'sections' => collect(),
                    'unread' => 0,
                    'unreadInquiries' => 0,
                ]);

                return;
            }

            \App\Support\CmsPageDefaults::ensure();

            $view->with([
                'sections' => CmsSection::query()->orderBy('sort_order')->get(['id', 'key', 'label', 'sort_order']),
                'unread' => ContactMessage::query()->where('is_read', false)->count(),
                'unreadInquiries' => Schema::hasTable('seo_service_inquiries')
                    ? SeoServiceInquiry::query()->where('status', SeoServiceInquiry::STATUS_NEW)->count()
                    : 0,
                'aboutPage' => Schema::hasTable('service_pages')
                    ? ServicePage::query()->where('slug', 'about-us')->first(['id', 'slug', 'name'])
                    : null,
            ]);
        });
    }
}
