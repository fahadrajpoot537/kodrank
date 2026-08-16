<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $c = CmsSection::getMap();

        return view('home.index', compact('c'));
    }
}
