<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BlogMedia
{
    public static function storeUpload(UploadedFile $file, string $subdir = 'uploads'): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            $ext = 'jpg';
        }

        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $base = $base !== '' ? $base : 'image';
        $name = $base.'-'.Str::lower(Str::random(6)).'.'.$ext;
        $dir = public_path('media/blog/'.$subdir);

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $name);

        return 'media/blog/'.$subdir.'/'.$name;
    }
}
