<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class Explore
{
    public function __invoke(): View
    {
        return view('explore');
    }
}
