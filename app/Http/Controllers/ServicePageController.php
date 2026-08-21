<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use App\Models\ServicePage;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServicePageController extends Controller
{
    public function index(): View
    {
        $c = CmsSection::getMap();
        $groups = ServicePage::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->with([
                'children' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')->orderBy('name'),
            ])
            ->get();

        return view('services.index', [
            'c' => $c,
            'groups' => $groups,
            'pageTitle' => 'Our Services — KodRank | Web Development & SEO Agency',
            'pageDescription' => 'Explore KodRank\'s full range of SEO and web development services — from monthly SEO and technical optimization to WordPress, Shopify, and custom AI chatbots.',
            'bodyClass' => 'page-services-index',
        ]);
    }

    public function digitalMarketing(): View|Response
    {
        return $this->show('digital-marketing-services');
    }

    public function show(string $slug): View|Response
    {
        $page = ServicePage::findBySlug($slug);

        if (! $page) {
            abort(404);
        }

        $page->loadMissing('parent');

        $c = CmsSection::getMap();
        $s = $page->sectionMap();
        $seo = $page->seo ?? [];

        return view('services.show', [
            'c' => $c,
            's' => $s,
            'page' => $page,
            'seo' => $seo,
        ]);
    }
}
