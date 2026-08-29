<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePage;
use App\Models\ServicePageSection;
use App\Support\ContentTemplates;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServicePageController extends Controller
{
    public function index(): View
    {
        $pages = ServicePage::query()
            ->with(['sections', 'childrenRecursive'])
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.service-pages.index', compact('pages'));
    }

    public function create(Request $request): View
    {
        $parentId = $request->integer('parent') ?: null;
        $parent = $parentId
            ? ServicePage::query()->find($parentId)
            : null;

        return view('admin.service-pages.create', [
            'parent' => $parent,
            'parents' => ServicePage::parentOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:service_pages,slug'],
            'parent_id' => ['nullable', 'integer', 'exists:service_pages,id'],
            'is_active' => ['nullable', 'boolean'],
            'with_template' => ['nullable', 'boolean'],
            'theme' => ['nullable', 'string', Rule::in(['digital-marketing', 'web-development', 'seo-service', 'about', 'wordpress', 'ai-chatbot', 'cms', 'website-redesign', 'shopify', 'saas-seo', 'monthly-seo', 'b2b-seo', 'ecommerce-seo', 'wordpress-seo', 'theme-html', 'industries', 'guest-posting', 'restaurant-seo', 'healthcare-seo', 'real-estate-seo', 'electrician', 'saas-development'])],
        ]);

        $slug = $data['slug'] ?? Str::slug($data['name']);
        if ($slug === '') {
            $slug = 'service-'.Str::lower(Str::random(6));
        }

        $parentId = $data['parent_id'] ?? null;
        $sort = (int) ServicePage::query()
            ->when(
                $parentId,
                fn ($q) => $q->where('parent_id', $parentId),
                fn ($q) => $q->whereNull('parent_id')
            )
            ->max('sort_order') + 1;

        $theme = $data['theme'] ?? 'digital-marketing';
        if ($parentId) {
            $parentTheme = ServicePage::query()->where('id', $parentId)->value('seo');
            if (is_array($parentTheme) && ! empty($parentTheme['theme']) && empty($data['theme'])) {
                $theme = $parentTheme['theme'];
            }
        }

        $page = ServicePage::create([
            'parent_id' => $parentId,
            'name' => $data['name'],
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $sort,
            'seo' => [
                'theme' => $theme,
                'seo_title' => $data['name'].' | KodRank',
                'seo_description' => '',
                'og_title' => $data['name'].' | KodRank',
                'og_description' => '',
                'og_image' => 'media/services/digital-marketing/hero.png',
                'keywords' => '',
                'robots' => 'index, follow',
                'canonical_url' => '',
            ],
        ]);

        if ($request->boolean('with_template', true)) {
            foreach (ContentTemplates::servicePageSectionsForTheme($theme) as $section) {
                $page->sections()->create($section);
            }
        }

        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();

        $msg = $page->isMain()
            ? 'Main service created. It appears as a column under Services.'
            : 'Sub service created under “'.($page->parent?->name ?? 'parent').'”.';

        return redirect()
            ->route('admin.service-pages.content', $page)
            ->with('success', $msg.' Live at /'.$page->slug);
    }

    public function destroy(ServicePage $page): RedirectResponse
    {
        $slug = $page->slug;
        $page->delete();
        ServicePage::forgetCache($slug);
        ServicePage::forgetNavCache();

        return redirect()
            ->route('admin.service-pages.index')
            ->with('success', 'Service deleted. Child pages (if any) became top-level.');
    }

    public function content(ServicePage $page): View
    {
        $page->load(['sections', 'parent']);

        return view('admin.service-pages.content', [
            'page' => $page,
            'theme' => $page->seo['theme'] ?? 'digital-marketing',
        ]);
    }

    public function toggleActive(ServicePage $page): RedirectResponse
    {
        $page->update(['is_active' => ! $page->is_active]);
        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();

        return back()->with('success', $page->name.' is now '.($page->is_active ? 'Active' : 'Inactive').'.');
    }

    public function editSeo(ServicePage $page): View
    {
        return view('admin.service-pages.seo', [
            'page' => $page,
            'seo' => $page->seo ?? [],
            'parents' => ServicePage::parentOptions($page->id),
        ]);
    }

    public function updateSeo(Request $request, ServicePage $page): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:180', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('service_pages', 'slug')->ignore($page->id)],
            'parent_id' => ['nullable', 'integer', 'exists:service_pages,id', Rule::notIn([$page->id])],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'seo' => ['nullable', 'array'],
        ]);

        $parentId = $validated['parent_id'] ?? null;
        if ($parentId && ServicePage::parentOptions($page->id)->where('id', $parentId)->isEmpty()) {
            return back()->withErrors(['parent_id' => 'Invalid parent selected.'])->withInput();
        }

        $oldSlug = $page->slug;
        $seo = is_array($validated['seo'] ?? null) ? $validated['seo'] : [];
        $seo['hide_from_nav'] = $request->boolean('hide_from_nav');

        $page->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'parent_id' => $parentId,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) ($validated['sort_order'] ?? $page->sort_order),
            'seo' => $seo,
        ]);

        ServicePage::forgetCache($oldSlug);
        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();

        return redirect()
            ->route('admin.service-pages.seo', $page)
            ->with('success', 'Page settings saved.');
    }

    public function createSection(ServicePage $page): View
    {
        return view('admin.service-pages.section-create', [
            'page' => $page,
            'types' => ContentTemplates::sectionTypes(),
        ]);
    }

    public function storeSection(Request $request, ServicePage $page): RedirectResponse
    {
        $types = ContentTemplates::sectionTypes();
        $validated = $request->validate([
            'key' => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-z0-9_]+$/',
                Rule::unique('service_page_sections', 'key')->where(fn ($q) => $q->where('service_page_id', $page->id)),
            ],
            'label' => ['required', 'string', 'max:120'],
            'type' => ['required', 'string', Rule::in(array_keys($types))],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $template = $types[$validated['type']];
        $sort = $validated['sort_order'] ?? ((int) $page->sections()->max('sort_order') + 1);

        $section = $page->sections()->create([
            'key' => $validated['key'],
            'label' => $validated['label'],
            'sort_order' => $sort,
            'data' => $template['data'],
        ]);

        ServicePage::forgetCache($page->slug);

        return redirect()
            ->route('admin.service-pages.sections.edit', [$page, $section->key])
            ->with('success', 'Section added. Fill in the content below.');
    }

    public function destroySection(ServicePage $page, string $key): RedirectResponse
    {
        $section = ServicePageSection::query()
            ->where('service_page_id', $page->id)
            ->where('key', $key)
            ->firstOrFail();

        $section->delete();
        ServicePage::forgetCache($page->slug);

        return redirect()
            ->route('admin.service-pages.content', $page)
            ->with('success', 'Section deleted.');
    }

    public function editSection(ServicePage $page, string $key): View
    {
        $section = ServicePageSection::query()
            ->where('service_page_id', $page->id)
            ->where('key', $key)
            ->firstOrFail();

        return view('admin.service-pages.section', compact('page', 'section'));
    }

    public function updateSection(Request $request, ServicePage $page, string $key): RedirectResponse
    {
        $section = ServicePageSection::query()
            ->where('service_page_id', $page->id)
            ->where('key', $key)
            ->firstOrFail();

        $data = $request->input('data', []);
        if (! is_array($data)) {
            $data = [];
        }

        $uploads = $request->file('uploads', []);
        if (is_array($uploads) && $uploads !== []) {
            $data = $this->mergeUploads($data, $uploads, $page);
        }

        $label = trim((string) $request->input('label', $section->label));
        $sort = (int) $request->input('sort_order', $section->sort_order);

        $section->update([
            'label' => $label !== '' ? $label : $section->label,
            'sort_order' => $sort,
            'data' => $this->normalize($data),
        ]);
        ServicePage::forgetCache($page->slug);

        return redirect()
            ->route('admin.service-pages.sections.edit', [$page, $section->key])
            ->with('success', $section->label.' saved successfully.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $uploads
     * @return array<string, mixed>
     */
    private function mergeUploads(array $data, array $uploads, ServicePage $page): array
    {
        foreach ($uploads as $key => $value) {
            if ($value instanceof UploadedFile) {
                if ($value->isValid()) {
                    $data[$key] = $this->storeSectionImage($value, $page);
                }
                continue;
            }

            if (is_array($value)) {
                $child = is_array($data[$key] ?? null) ? $data[$key] : [];
                $data[$key] = $this->mergeUploads($child, $value, $page);
            }
        }

        return $data;
    }

    private function storeSectionImage(UploadedFile $file, ServicePage $page): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            $ext = 'jpg';
        }

        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $base = $base !== '' ? $base : 'image';
        $dir = 'service-media/'.$page->slug;
        $name = $base.'-'.Str::lower(Str::random(6)).'.'.$ext;
        $relative = $dir.'/'.$name;

        Storage::disk('public')->makeDirectory($dir);
        Storage::disk('public')->putFileAs($dir, $file, $name);

        return 'storage/'.$relative;
    }

    private function normalize(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if ($this->isList($value)) {
                    $data[$key] = array_values(array_map(
                        fn ($item) => is_array($item) ? $this->normalize($item) : $item,
                        array_filter($value, fn ($item) => ! $this->isEmptyRow($item))
                    ));
                } else {
                    $data[$key] = $this->normalize($value);
                }
            } elseif (is_string($value)) {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    private function isList(array $array): bool
    {
        return $array === [] || array_keys($array) === range(0, count($array) - 1);
    }

    private function isEmptyRow(mixed $item): bool
    {
        if (! is_array($item)) {
            return $item === null || $item === '';
        }

        foreach ($item as $value) {
            if (is_array($value)) {
                if (! $this->isEmptyRow($value)) {
                    return false;
                }
            } elseif (trim((string) $value) !== '') {
                return false;
            }
        }

        return true;
    }
}
