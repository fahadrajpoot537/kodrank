<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class VisitorDay extends Model
{
    protected $fillable = [
        'visitor_key',
        'visited_on',
    ];

    protected function casts(): array
    {
        return [
            'visited_on' => 'date',
        ];
    }

    /**
     * Distinct visitors whose first hit in the window falls inside each range.
     * A person is counted once per range, even if they open many pages.
     *
     * @return array{day: int, week: int, days15: int, month: int, months3: int, year: int}
     */
    public static function uniqueCounts(): array
    {
        $today = Carbon::today();
        $windows = [
            'day' => $today->copy(),
            'week' => $today->copy()->subDays(6),
            'days15' => $today->copy()->subDays(14),
            'month' => $today->copy()->subDays(29),
            'months3' => $today->copy()->subDays(89),
            'year' => $today->copy()->subDays(364),
        ];

        $counts = [];
        foreach ($windows as $key => $from) {
            $counts[$key] = (int) static::query()
                ->whereDate('visited_on', '>=', $from->toDateString())
                ->distinct()
                ->count('visitor_key');
        }

        return $counts;
    }
}
