<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SeoServiceImageSitemapService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SeoServiceMediaController extends Controller
{
    private const DISK = 'public';

    private const ROOT = 'seo-services';

    public function index(Request $request): View
    {
        $folder = $this->safeFolder($request->string('folder')->toString());
        $path = self::ROOT.($folder !== '' ? '/'.$folder : '');

        $disk = Storage::disk(self::DISK);
        if (! $disk->exists($path)) {
            $disk->makeDirectory($path);
        }

        $files = collect($disk->files($path))
            ->filter(fn (string $file) => preg_match('/\.(jpe?g|png|webp|gif)$/i', $file))
            ->map(function (string $file) use ($disk) {
                return [
                    'path' => $file,
                    'name' => basename($file),
                    'url' => $disk->url($file),
                    'size' => $disk->size($file),
                    'updated_at' => $disk->lastModified($file),
                ];
            })
            ->sortByDesc('updated_at')
            ->values();

        $folders = [
            '' => 'All / root',
            'on-page' => 'On-page SEO',
            'off-page' => 'Off-page SEO',
            'about' => 'About Us',
            'geo' => 'GEO',
            'aeo' => 'AEO',
            'technical' => 'Technical SEO',
            'blog' => 'Blog',
            'general' => 'General',
        ];

        return view('admin.seo-media.index', [
            'files' => $files,
            'folder' => $folder,
            'folders' => $folders,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'folder' => ['nullable', 'string', 'max:40'],
            'image' => ['required', 'image', 'max:5120'],
            'crop_x' => ['nullable', 'numeric', 'min:0'],
            'crop_y' => ['nullable', 'numeric', 'min:0'],
            'crop_w' => ['nullable', 'numeric', 'min:1'],
            'crop_h' => ['nullable', 'numeric', 'min:1'],
        ]);

        $folder = $this->safeFolder($data['folder'] ?? '');
        $dir = self::ROOT.($folder !== '' ? '/'.$folder : '');
        $disk = Storage::disk(self::DISK);
        $disk->makeDirectory($dir);

        $file = $request->file('image');
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            $ext = 'jpg';
        }

        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $name = ($name !== '' ? $name : 'image').'-'.Str::lower(Str::random(6)).'.'.$ext;
        $relative = $dir.'/'.$name;

        $binary = file_get_contents($file->getRealPath());
        if ($binary === false) {
            return back()->withErrors(['image' => 'Could not read uploaded file.']);
        }

        if (
            extension_loaded('gd')
            && isset($data['crop_w'], $data['crop_h'])
            && (float) $data['crop_w'] > 0
            && (float) $data['crop_h'] > 0
        ) {
            $cropped = $this->crop($binary, $ext, (float) ($data['crop_x'] ?? 0), (float) ($data['crop_y'] ?? 0), (float) $data['crop_w'], (float) $data['crop_h']);
            if ($cropped !== null) {
                $binary = $cropped;
            }
        }

        $disk->put($relative, $binary);
        SeoServiceImageSitemapService::forgetCache();

        return back()->with('success', 'Image uploaded. Public path: storage/'.$relative);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'path' => ['required', 'string', 'max:255'],
        ]);

        $path = str_replace('\\', '/', $data['path']);
        if (! str_starts_with($path, self::ROOT.'/')) {
            return back()->withErrors(['path' => 'Invalid media path.']);
        }

        Storage::disk(self::DISK)->delete($path);
        SeoServiceImageSitemapService::forgetCache();

        return back()->with('success', 'Image deleted.');
    }

    private function safeFolder(?string $folder): string
    {
        $folder = trim((string) $folder, '/');
        if ($folder === '' || ! in_array($folder, ['on-page', 'off-page', 'about', 'geo', 'aeo', 'technical', 'blog', 'general'], true)) {
            return '';
        }

        return $folder;
    }

    private function crop(string $binary, string $ext, float $x, float $y, float $w, float $h): ?string
    {
        $src = @imagecreatefromstring($binary);
        if ($src === false) {
            return null;
        }

        $sw = imagesx($src);
        $sh = imagesy($src);
        $x = (int) max(0, min($sw - 1, $x));
        $y = (int) max(0, min($sh - 1, $y));
        $w = (int) max(1, min($sw - $x, $w));
        $h = (int) max(1, min($sh - $y, $h));

        $dst = imagecreatetruecolor($w, $h);
        if ($dst === false) {
            imagedestroy($src);

            return null;
        }

        imagecopy($dst, $src, 0, 0, $x, $y, $w, $h);

        ob_start();
        match ($ext) {
            'png' => imagepng($dst),
            'webp' => function_exists('imagewebp') ? imagewebp($dst, null, 85) : imagejpeg($dst, null, 85),
            'gif' => imagegif($dst),
            default => imagejpeg($dst, null, 88),
        };
        $out = ob_get_clean();

        imagedestroy($src);
        imagedestroy($dst);

        return is_string($out) ? $out : null;
    }
}
