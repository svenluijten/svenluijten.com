<?php

namespace App\Http\Controllers\Articles;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class Index
{
    public function __invoke(): View
    {
        $articles = Article::latest('published_at')->get();

        return view('articles.index', [
            'articles' => $articles,
        ]);
    }
}
