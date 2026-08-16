<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use App\Models\ServicePage;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServicePageController extends Controller
{
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
