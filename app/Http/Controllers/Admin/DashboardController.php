<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsSection;
use App\Models\ContactMessage;
use App\Models\SeoServiceInquiry;
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
        ]);
    }
}
