<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use App\Support\ResultsPageDefaults;
use Illuminate\View\View;

class ResultsController extends Controller
{
    public function show(): View
    {
        $c = CmsSection::getMap();
        $p = array_merge(ResultsPageDefaults::data(), is_array($c['results_page'] ?? null) ? $c['results_page'] : []);

        return view('results.show', [
            'c' => $c,
            'p' => $p,
            'navStuck' => true,
            'bodyClass' => 'page-results',
            'pageTitle' => $p['seo_title'] ?? 'Results — KodRank',
            'pageDescription' => $p['seo_description'] ?? '',
            'pageOgImage' => $p['og_image'] ?? null,
        ]);
    }
}
