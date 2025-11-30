<?php

namespace App\Http\Controllers\Concerts;

use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Show
{
    public function __invoke(string $date, Concert $concert): View
    {
        return view('concerts.show', [
            'concert' => $concert,
        ]);
    }
}
