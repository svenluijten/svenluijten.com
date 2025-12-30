<?php

namespace App\Http\Controllers\BlogPosts;

use App\Models\BlogPost;
use App\Models\Scopes\PublishedScope;
use Illuminate\Contracts\View\View;

class Show
{
    public function __invoke(string $blogPost): View
    {
        $post = BlogPost::query()
            ->withoutGlobalScope(PublishedScope::class)
            ->where('slug', $blogPost)
            ->firstOrFail();

        return view('blog-posts.show', [
            'blogPost' => $post,
        ]);
    }
}
