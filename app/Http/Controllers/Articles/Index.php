<?php

namespace App\Http\Controllers\Articles;

class Index
{
    public function __invoke()
    {
        return view('articles.index');
    }
}
