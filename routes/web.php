<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogCategoryController as AdminBlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\BlogSettingsController as AdminBlogSettingsController;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NewsletterSubscriberController as AdminNewsletterSubscriberController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SeoServiceInquiryController as AdminSeoServiceInquiryController;
use App\Http\Controllers\Admin\SeoServiceMediaController;
use App\Http\Controllers\Admin\ServicePageController as AdminServicePageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SeoServiceInquiryController;
use App\Http\Controllers\ServicePageController;
use App\Models\BlogPost;
use App\Models\ServicePage;
use App\Services\SeoServiceImageSitemapService;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');

Route::middleware('throttle:12,1')->group(function () {
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::post('/seo-services/inquiry', [SeoServiceInquiryController::class, 'store'])->name('seo-services.inquiry.store');
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.store');
});

// One-click cache clear (local + live). Use ?key= from .env CACHE_CLEAR_KEY
Route::get('/clear-cache', [CacheController::class, 'clearPublic'])->name('cache.clear.public');

Route::get('/digital-marketing-services', [ServicePageController::class, 'digitalMarketing'])
    ->name('services.digital-marketing');

Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('blog.show');

Route::redirect('/blog', '/blogs', 301);
Route::get('/blog/{slug}', function (string $slug) {
    return redirect('/blogs/'.$slug, 301);
})->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*');

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => url('/contact'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => url('/blogs'), 'changefreq' => 'weekly', 'priority' => '0.8'],
    ];

    $pages = ServicePage::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['slug']);

    foreach ($pages as $page) {
        $urls[] = [
            'loc' => url('/'.$page->slug),
            'changefreq' => 'weekly',
            'priority' => $page->slug === 'digital-marketing-services' ? '0.8' : '0.7',
        ];
    }

    $blogPosts = BlogPost::query()
        ->published()
        ->orderByDesc('published_at')
        ->get(['slug']);

    foreach ($blogPosts as $post) {
        $urls[] = [
            'loc' => url('/blogs/'.$post->slug),
            'changefreq' => 'weekly',
            'priority' => '0.6',
        ];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>'.e($url['loc']).'</loc>';
        $xml .= '<changefreq>'.$url['changefreq'].'</changefreq>';
        $xml .= '<priority>'.$url['priority'].'</priority>';
        $xml .= '</url>';
    }
    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/image-sitemap.xml', function (SeoServiceImageSitemapService $sitemap) {
    return response($sitemap->toXml(), 200)->header('Content-Type', 'application/xml');
})->name('image-sitemap');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/clear-cache', [CacheController::class, 'clear'])->name('cache.clear');

        Route::get('/homepage', [SectionController::class, 'index'])->name('homepage.index');
        Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/sections/{key}', [SectionController::class, 'edit'])->name('sections.edit');
        Route::put('/sections/{key}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{key}', [SectionController::class, 'destroy'])->name('sections.destroy');

        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('/seo-inquiries', [AdminSeoServiceInquiryController::class, 'index'])->name('seo-inquiries.index');
        Route::get('/seo-inquiries/export', [AdminSeoServiceInquiryController::class, 'export'])->name('seo-inquiries.export');
        Route::get('/seo-inquiries/{inquiry}', [AdminSeoServiceInquiryController::class, 'show'])->name('seo-inquiries.show');
        Route::post('/seo-inquiries/{inquiry}/mark-read', [AdminSeoServiceInquiryController::class, 'markRead'])->name('seo-inquiries.mark-read');
        Route::post('/seo-inquiries/{inquiry}/mark-replied', [AdminSeoServiceInquiryController::class, 'markReplied'])->name('seo-inquiries.mark-replied');
        Route::delete('/seo-inquiries/{inquiry}', [AdminSeoServiceInquiryController::class, 'destroy'])->name('seo-inquiries.destroy');

        Route::get('/seo-media', [SeoServiceMediaController::class, 'index'])->name('seo-media.index');
        Route::post('/seo-media', [SeoServiceMediaController::class, 'store'])->name('seo-media.store');
        Route::delete('/seo-media', [SeoServiceMediaController::class, 'destroy'])->name('seo-media.destroy');

        Route::get('/blog', [AdminBlogPostController::class, 'index'])->name('blog.posts.index');
        Route::get('/blog/posts/create', [AdminBlogPostController::class, 'create'])->name('blog.posts.create');
        Route::post('/blog/posts', [AdminBlogPostController::class, 'store'])->name('blog.posts.store');
        Route::post('/blog/posts/editor-image', [AdminBlogPostController::class, 'uploadEditorImage'])->name('blog.posts.editor-image');
        Route::get('/blog/posts/{post}/edit', [AdminBlogPostController::class, 'edit'])->name('blog.posts.edit');
        Route::put('/blog/posts/{post}', [AdminBlogPostController::class, 'update'])->name('blog.posts.update');
        Route::delete('/blog/posts/{post}', [AdminBlogPostController::class, 'destroy'])->name('blog.posts.destroy');

        Route::get('/blog/categories', [AdminBlogCategoryController::class, 'index'])->name('blog.categories.index');
        Route::post('/blog/categories', [AdminBlogCategoryController::class, 'store'])->name('blog.categories.store');
        Route::put('/blog/categories/{category}', [AdminBlogCategoryController::class, 'update'])->name('blog.categories.update');
        Route::delete('/blog/categories/{category}', [AdminBlogCategoryController::class, 'destroy'])->name('blog.categories.destroy');

        Route::get('/blog/settings', [AdminBlogSettingsController::class, 'edit'])->name('blog.settings.edit');
        Route::put('/blog/settings', [AdminBlogSettingsController::class, 'update'])->name('blog.settings.update');
        Route::get('/newsletter', [AdminNewsletterSubscriberController::class, 'index'])->name('newsletter.index');
        Route::post('/newsletter/{subscriber}/toggle', [AdminNewsletterSubscriberController::class, 'toggle'])->name('newsletter.toggle');
        Route::delete('/newsletter/{subscriber}', [AdminNewsletterSubscriberController::class, 'destroy'])->name('newsletter.destroy');

        Route::get('/service-pages', [AdminServicePageController::class, 'index'])->name('service-pages.index');
        Route::get('/service-pages/create', [AdminServicePageController::class, 'create'])->name('service-pages.create');
        Route::post('/service-pages', [AdminServicePageController::class, 'store'])->name('service-pages.store');
        Route::delete('/service-pages/{page}', [AdminServicePageController::class, 'destroy'])->name('service-pages.destroy');
        Route::get('/service-pages/{page}/content', [AdminServicePageController::class, 'content'])->name('service-pages.content');
        Route::post('/service-pages/{page}/toggle', [AdminServicePageController::class, 'toggleActive'])->name('service-pages.toggle');

        Route::get('/service-pages/{page}/seo', [AdminServicePageController::class, 'editSeo'])->name('service-pages.seo');
        Route::put('/service-pages/{page}/seo', [AdminServicePageController::class, 'updateSeo'])->name('service-pages.seo.update');

        Route::get('/service-pages/{page}/sections/create', [AdminServicePageController::class, 'createSection'])->name('service-pages.sections.create');
        Route::post('/service-pages/{page}/sections', [AdminServicePageController::class, 'storeSection'])->name('service-pages.sections.store');
        Route::get('/service-pages/{page}/sections/{key}', [AdminServicePageController::class, 'editSection'])->name('service-pages.sections.edit');
        Route::put('/service-pages/{page}/sections/{key}', [AdminServicePageController::class, 'updateSection'])->name('service-pages.sections.update');
        Route::delete('/service-pages/{page}/sections/{key}', [AdminServicePageController::class, 'destroySection'])->name('service-pages.sections.destroy');
    });
});

Route::get('/{slug}', [ServicePageController::class, 'show'])
    ->where('slug', '^(?!admin$|blog$|blogs$|sitemap\\.xml$|image-sitemap\\.xml$|clear-cache$)[a-z0-9]+(?:-[a-z0-9]+)*$')
    ->name('services.show');
