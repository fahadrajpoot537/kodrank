<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use App\Models\ServicePage;
use App\Support\CmsPageDefaults;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServicePageController extends Controller
{
    public function index(): View
    {
        $c = CmsSection::getMap();
        $idx = array_merge(CmsPageDefaults::servicesIndex(), is_array($c['services_index'] ?? null) ? $c['services_index'] : []);
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
            'idx' => $idx,
            'groups' => $groups,
            'pageTitle' => $idx['seo_title'] ?? 'Our Services — KodRank',
            'pageDescription' => $idx['seo_description'] ?? '',
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
