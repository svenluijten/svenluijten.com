<?php

namespace App\Http\Controllers\Concerts;

use App\Models\Concert;
use Illuminate\Contracts\View\View;

class Index
{
    public function __invoke(): View
    {
        /** @var \Illuminate\Database\Eloquent\Collection<Concert> $concerts */
        $concerts = Concert::query()
            ->latest('date')
            ->get();

        $groupedConcerts = $concerts->groupBy(fn (Concert $concert) => $concert->date->format('Y'));

        return view('concerts.index', [
            'groupedConcerts' => $groupedConcerts,
        ]);
    }
}
