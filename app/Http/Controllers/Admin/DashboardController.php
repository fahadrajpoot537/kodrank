<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsSection;
use App\Models\ContactMessage;
use App\Models\SeoServiceInquiry;
use App\Models\VisitorDay;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'sections' => CmsSection::query()->orderBy('sort_order')->get(),
            'unread' => ContactMessage::query()->where('is_read', false)->count(),
            'unreadInquiries' => SeoServiceInquiry::query()->where('status', SeoServiceInquiry::STATUS_NEW)->count(),
            'messages' => ContactMessage::query()->latest()->take(5)->get(),
            'inquiries' => SeoServiceInquiry::query()->latest()->take(5)->get(),
            'visitors' => Schema::hasTable('visitor_days') ? VisitorDay::uniqueCounts() : [
                'day' => 0,
                'week' => 0,
                'days15' => 0,
                'month' => 0,
                'months3' => 0,
                'year' => 0,
            ],
        ]);
    }
}
