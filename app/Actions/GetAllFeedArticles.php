<?php

namespace App\Actions;

use App\Feeds\FeedItem;
use App\Makeable;
use App\Models\Article;
use Illuminate\Support\Collection;

class GetAllFeedArticles
{
    use Makeable;

    /**
     * @return \Illuminate\Support\Collection<FeedItem>
     */
    public function execute(): Collection
    {
        return Article::query()
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->chunkMap(function (Article $article) {
                return new FeedItem(
                    id: $article->feed_id,
                    title: $article->title,
                    url: route('articles.show', $article),
                    content: $article->content,
                    updated: $article->updated_at,
                    published: $article->published_at,
                );
            });
    }
}
