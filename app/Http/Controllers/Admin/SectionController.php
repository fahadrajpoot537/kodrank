<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsSection;
use App\Support\ContentTemplates;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function index(): View
    {
        $sections = CmsSection::query()->orderBy('sort_order')->orderBy('label')->get();

        return view('admin.homepage.index', compact('sections'));
    }

    public function create(): View
    {
        return view('admin.sections.create', [
            'types' => ContentTemplates::homepageSectionTypes(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $types = ContentTemplates::homepageSectionTypes();
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:80', 'regex:/^[a-z0-9_]+$/', 'unique:cms_sections,key'],
            'label' => ['required', 'string', 'max:120'],
            'type' => ['required', 'string', Rule::in(array_keys($types))],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $template = $types[$validated['type']];
        $sort = $validated['sort_order'] ?? ((int) CmsSection::query()->max('sort_order') + 1);

        $section = CmsSection::create([
            'key' => $validated['key'],
            'label' => $validated['label'],
            'sort_order' => $sort,
            'data' => $template['data'],
        ]);

        return redirect()
            ->route('admin.sections.edit', $section->key)
            ->with('success', 'Homepage section created. Fill in the content below.');
    }

    public function edit(string $key): View
    {
        $section = CmsSection::query()->where('key', $key)->firstOrFail();

        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, string $key): RedirectResponse
    {
        $section = CmsSection::query()->where('key', $key)->firstOrFail();
        $data = $request->input('data', []);

        if (! is_array($data)) {
            $data = [];
        }

        $uploads = $request->file('uploads', []);
        if (is_array($uploads) && $uploads !== []) {
            $data = $this->mergeUploads($data, $uploads);
        }

        $label = trim((string) $request->input('label', $section->label));
        $sort = (int) $request->input('sort_order', $section->sort_order);

        $section->update([
            'label' => $label !== '' ? $label : $section->label,
            'sort_order' => $sort,
            'data' => $this->normalize($data),
        ]);

        return redirect()
            ->route('admin.sections.edit', $section->key)
            ->with('success', $section->label.' saved successfully.');
    }

    public function destroy(string $key): RedirectResponse
    {
        $section = CmsSection::query()->where('key', $key)->firstOrFail();
        $section->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Homepage section deleted.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $uploads
     * @return array<string, mixed>
     */
    private function mergeUploads(array $data, array $uploads): array
    {
        foreach ($uploads as $key => $value) {
            if ($value instanceof UploadedFile) {
                if ($value->isValid()) {
                    $data[$key] = $this->storeImage($value);
                }
                continue;
            }

            if (is_array($value)) {
                $child = is_array($data[$key] ?? null) ? $data[$key] : [];
                $data[$key] = $this->mergeUploads($child, $value);
            }
        }

        return $data;
    }

    private function storeImage(UploadedFile $file): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            $ext = 'jpg';
        }

        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $base = $base !== '' ? $base : 'image';
        $dir = 'service-media/homepage';
        $name = $base.'-'.Str::lower(Str::random(6)).'.'.$ext;

        Storage::disk('public')->makeDirectory($dir);
        Storage::disk('public')->putFileAs($dir, $file, $name);

        return 'storage/'.$dir.'/'.$name;
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
