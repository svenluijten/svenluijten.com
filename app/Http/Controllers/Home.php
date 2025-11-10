<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BlogPost;
use App\Models\Concert;

class Home
{
    public function __invoke()
    {
        return view('index', [
            'recentArticles' => Article::latest('published_at')->take(5)->get(),
            'recentBlogPosts' => BlogPost::latest('published_at')->take(5)->get(),
            'recentConcerts' => Concert::latest('published_at')->take(4)->get(),
        ]);
    }
}
