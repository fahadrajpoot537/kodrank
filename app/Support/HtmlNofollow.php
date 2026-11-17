<?php

namespace App\Support;

/**
 * Removes rel="nofollow" from internal links.
 * External links and /admin links keep nofollow.
 */
final class HtmlNofollow
{
    /**
     * @param  list<string>|null  $hosts
     */
    public static function stripInternal(string $html, ?array $hosts = null): string
    {
        if ($html === '' || stripos($html, 'nofollow') === false) {
            return $html;
        }

        $hosts = self::normalizeHosts($hosts ?? self::defaultHosts());

        $updated = preg_replace_callback('/<a\b[^>]*>/i', function (array $match) use ($hosts): string {
            $tag = $match[0];
            if (! preg_match('/\bhref\s*=\s*(["\'])(.*?)\1/i', $tag, $hrefMatch)) {
                return $tag;
            }

            $href = html_entity_decode($hrefMatch[2], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (! self::isInternal($href, $hosts) || self::isAdmin($href)) {
                return $tag;
            }

            return self::removeNofollowToken($tag);
        }, $html);

        return is_string($updated) ? $updated : $html;
    }

    /**
     * @param  list<string>|null  $hosts
     */
    public static function stripInternalDeep(mixed $value, ?array $hosts = null, ?bool &$changed = null): mixed
    {
        $hosts = self::normalizeHosts($hosts ?? self::defaultHosts());

        return self::walk($value, $hosts, $changed);
    }

    /**
     * @return list<string>
     */
    public static function defaultHosts(): array
    {
        $appHost = strtolower((string) parse_url((string) config('app.url'), PHP_URL_HOST));

        return array_values(array_filter([
            $appHost,
            'kodrank.com',
            'www.kodrank.com',
        ]));
    }

    /**
     * @param  list<string>  $hosts
     * @return list<string>
     */
    private static function normalizeHosts(array $hosts): array
    {
        $normalized = [];
        foreach ($hosts as $host) {
            $host = strtolower(trim($host));
            if ($host === '') {
                continue;
            }
            $normalized[] = $host;
            if (str_starts_with($host, 'www.')) {
                $normalized[] = substr($host, 4);
            } else {
                $normalized[] = 'www.'.$host;
            }
        }

        return array_values(array_unique($normalized));
    }

    /**
     * @param  list<string>  $hosts
     */
    private static function walk(mixed $value, array $hosts, ?bool &$changed): mixed
    {
        if (is_string($value)) {
            $clean = self::stripInternal($value, $hosts);
            if ($clean !== $value) {
                $changed = true;
            }

            return $clean;
        }

        if (! is_array($value)) {
            return $value;
        }

        foreach ($value as $key => $item) {
            $value[$key] = self::walk($item, $hosts, $changed);
        }

        return $value;
    }

    /**
     * @param  list<string>  $hosts
     */
    private static function isInternal(string $href, array $hosts): bool
    {
        $href = trim($href);
        if ($href === '' || str_starts_with($href, '#') || str_starts_with($href, '?')) {
            return true;
        }

        if (preg_match('/^(mailto:|tel:|sms:|javascript:)/i', $href)) {
            return false;
        }

        $parts = parse_url($href);
        if (! is_array($parts)) {
            return false;
        }

        if (! isset($parts['host'])) {
            return true;
        }

        return in_array(strtolower($parts['host']), $hosts, true);
    }

    private static function isAdmin(string $href): bool
    {
        $parts = parse_url(trim($href));
        $path = is_array($parts) ? (string) ($parts['path'] ?? '') : '';
        if ($path === '' && is_array($parts) && ! isset($parts['host'])) {
            $path = trim($href);
        }

        $path = '/'.ltrim($path, '/');

        return $path === '/admin' || str_starts_with($path, '/admin/');
    }

    private static function removeNofollowToken(string $tag): string
    {
        $updated = preg_replace_callback(
            '/\srel\s*=\s*(["\'])(.*?)\1/i',
            function (array $match): string {
                $tokens = preg_split('/\s+/', trim($match[2])) ?: [];
                $tokens = array_values(array_filter(
                    $tokens,
                    fn (string $token): bool => strcasecmp($token, 'nofollow') !== 0
                ));

                if ($tokens === []) {
                    return '';
                }

                return ' rel='.$match[1].implode(' ', $tokens).$match[1];
            },
            $tag
        );

        return is_string($updated) ? $updated : $tag;
    }
}
