<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPageSetting;
use App\Support\BlogMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogSettingsController extends Controller
{
    public function edit(): View
    {
        $settings = BlogPageSetting::current();
        $row = BlogPageSetting::query()->first();

        return view('admin.blog.settings.edit', compact('settings', 'row'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_lede' => ['required', 'string'],
            'search_placeholder' => ['nullable', 'string', 'max:255'],
            'hero_background' => ['nullable', 'string', 'max:255'],
            'newsletter_eyebrow' => ['nullable', 'string', 'max:120'],
            'newsletter_title' => ['nullable', 'string', 'max:255'],
            'newsletter_title_html' => ['nullable', 'string'],
            'newsletter_copy' => ['nullable', 'string'],
            'newsletter_fine' => ['nullable', 'string', 'max:255'],
            'newsletter_placeholder' => ['nullable', 'string', 'max:120'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string'],
            'hero_background_file' => ['nullable', 'image', 'max:8192'],
        ]);

        unset($data['hero_background_file']);

        if ($request->hasFile('hero_background_file')) {
            $data['hero_background'] = BlogMedia::storeUpload($request->file('hero_background_file'));
        }

        $row = BlogPageSetting::query()->first();
        if ($row) {
            $row->update(['data' => array_merge(BlogPageSetting::defaults(), $row->data ?? [], $data)]);
        } else {
            BlogPageSetting::query()->create([
                'data' => array_merge(BlogPageSetting::defaults(), $data),
            ]);
        }

        BlogPageSetting::forgetCache();

        return back()->with('success', 'Blog page settings saved.');
    }
}
