<?php

namespace App\Http\Controllers\Articles;

use App\Models\Article;

class Show
{
    public function __invoke(Article $article)
    {
        return view('articles.show', [
            'article' => $article,
        ]);
    }
}
