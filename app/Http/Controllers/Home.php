<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BlogPost;
use App\Models\Concert;
use Laravel\Pennant\Feature;

class Home
{
    public function __invoke()
    {
        return view('index', [
            'recentArticles' => Article::query()->latest('published_at')->take(5)->get(),
            'recentConcerts' => Concert::query()->latest('date')->take(4)->get(),
            'recentBlogPosts' => BlogPost::query()->latest('published_at')->take(5)->get(),
        ]);
    }
}
