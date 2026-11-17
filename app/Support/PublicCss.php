<?php

namespace App\Support;

/**
 * Builds the public URL for a stylesheet in public/.
 *
 * CSS_USE_MINIFIED=false (the default) serves the original file.
 * CSS_USE_MINIFIED=true serves the sibling *.min.css file when it exists,
 * in the same position in the document. Originals are never rewritten.
 */
final class PublicCss
{
    public static function href(string $relativePath): string
    {
        $relativePath = str_replace('\\', '/', trim($relativePath));
        $relativePath = ltrim($relativePath, '/');

        $served = $relativePath;
        if (self::shouldServeMinified($relativePath)) {
            $minified = preg_replace('/\.css$/i', '.min.css', $relativePath);
            if (is_string($minified) && is_file(public_path($minified))) {
                $served = $minified;
            }
        }

        $absolute = public_path($served);
        $version = is_file($absolute) ? (string) filemtime($absolute) : (string) time();

        return asset($served).'?v='.$version;
    }

    private static function shouldServeMinified(string $relativePath): bool
    {
        if (! preg_match('/\.css$/i', $relativePath) || preg_match('/\.min\.css$/i', $relativePath)) {
            return false;
        }

        return filter_var(config('assets.use_minified_css'), FILTER_VALIDATE_BOOLEAN);
    }
}
