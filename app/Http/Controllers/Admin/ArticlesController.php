<?php

namespace App\Http\Controllers\Admin;

use App\Events\ArticleCreated;
use App\Events\ArticlePublished;
use App\Events\ArticleUpdated;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticlesController
{
    public function index(): View
    {
        $articles = Article::all();

        return view('admin.articles.index', ['articles' => $articles]);
    }

    public function store(CreateArticleRequest $request): RedirectResponse
    {
        $article = Article::query()->create([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'slug' => $request->string('slug'),
            'published_at' => $published = $request->date('published'),
        ]);

        event(new ArticleCreated($article));

        if ($published->lte(now())) {
            event(new ArticlePublished($article));
        }

        return redirect()->route('admin.articles');
    }

    public function show(Article $article): View
    {
        return view('admin.articles.show', ['article' => $article]);
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'slug' => $request->string('slug'),
            'published_at' => $request->date('published'),
        ]);

        event(new ArticleUpdated($article->fresh()));

        return redirect()->route('admin.articles.update', $article);
    }
}
