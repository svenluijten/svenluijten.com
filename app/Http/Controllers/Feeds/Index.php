<?php

namespace App\Http\Controllers\Feeds;

use Illuminate\Contracts\View\View;

class Index
{
    public function __invoke(): View
    {
        return view('feeds.index');
    }
}
