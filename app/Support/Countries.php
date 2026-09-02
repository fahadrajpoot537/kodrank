<?php

namespace App\Support;

class Countries
{
    /**
     * @return list<string>
     */
    public static function names(): array
    {
        static $names = null;

        if ($names === null) {
            $path = resource_path('data/countries.json');
            $decoded = is_file($path)
                ? json_decode((string) file_get_contents($path), true)
                : null;
            $names = is_array($decoded) ? array_values($decoded) : [];
        }

        return $names;
    }

    public static function isValid(string $country): bool
    {
        return in_array($country, self::names(), true);
    }
}
