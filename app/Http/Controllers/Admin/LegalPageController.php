<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalPageController extends Controller
{
    public function edit(string $slug): View
    {
        $page = $this->page($slug);
        $body = $this->bodyData($page);
        $hero = $page->sections->firstWhere('key', 'hero');
        $title = trim((string) ($body['title'] ?? ''));
        if ($title === '') {
            $title = trim(html_entity_decode(strip_tags((string) (($hero->data['title_html'] ?? null) ?: $page->name)), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        return view('admin.legal.edit', [
            'page' => $page,
            'title' => $title,
            'html' => (string) ($body['html'] ?? ''),
        ]);
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $page = $this->page($slug);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'html' => ['nullable', 'string', 'max:200000'],
        ]);

        $title = trim($validated['title']);
        $html = $this->cleanHtml((string) ($validated['html'] ?? ''));

        $section = $page->sections->firstWhere('key', 'body');
        $data = is_array($section?->data) ? $section->data : [];
        $data['title'] = $title;
        $data['html'] = $html;

        if ($section) {
            $section->update(['data' => $data]);
        } else {
            $page->sections()->create([
                'key' => 'body',
                'label' => 'Page content',
                'sort_order' => 1,
                'data' => $data,
            ]);
        }

        $hero = $page->sections->firstWhere('key', 'hero');
        if ($hero) {
            $heroData = is_array($hero->data) ? $hero->data : [];
            $heroData['title_html'] = $title;
            $hero->update(['data' => $heroData]);
        }

        $page->update(['name' => $title]);
        ServicePage::forgetCache($page->slug);

        return redirect()
            ->route('admin.legal.edit', $page->slug)
            ->with('success', $title.' saved.');
    }

    private function page(string $slug): ServicePage
    {
        abort_unless(in_array($slug, ['privacy-policy', 'terms-and-conditions'], true), 404);

        return ServicePage::query()
            ->where('slug', $slug)
            ->with('sections')
            ->firstOrFail();
    }

    /**
     * @return array<string, mixed>
     */
    private function bodyData(ServicePage $page): array
    {
        $section = $page->sections->firstWhere('key', 'body');

        return is_array($section?->data) ? $section->data : [];
    }

    private function cleanHtml(string $html): string
    {
        $html = preg_replace('#<(script|iframe|object|embed|form)\b[^>]*>.*?</\1>#is', '', $html) ?? $html;
        $html = preg_replace('/\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? $html;

        return preg_replace('/javascript\s*:/i', '', $html) ?? $html;
    }
}
