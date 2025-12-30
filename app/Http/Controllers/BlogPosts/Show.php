<?php

namespace App\Http\Controllers\BlogPosts;

use App\Models\BlogPost;
use Illuminate\Contracts\View\View;

class Show
{
    public function __invoke(BlogPost $blogPost): View
    {
        return view('blog-posts.show', [
            'blogPost' => $blogPost,
        ]);
    }
}
