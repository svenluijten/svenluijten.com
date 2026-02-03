<?php

namespace App\Http\Controllers\BlogPosts;

use App\Models\BlogPost;
use Illuminate\Contracts\View\View;
use Laravel\Pennant\Feature;

class Index
{
    public function __invoke(): View
    {
        /** @var \Illuminate\Database\Eloquent\Collection<BlogPost> $blogPosts */
        $blogPosts = BlogPost::query()
            ->latest('published_at')
            ->get();

        return view('blog-posts.index', [
            'blogPosts' => $blogPosts->groupBy(fn (BlogPost $blogPost) => $blogPost->published_at->format('Y')),
        ]);
    }
}
