<?php

namespace App\Console\Commands;

use App\Feeds\FeedItem;
use App\Models\Article;
use App\Models\Concert;
use DateTimeInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateFeeds extends Command
{
    protected $signature = 'app:generate-feeds';

    protected $description = '(Re)generate the Atom and JSON feeds.';

    public function handle()
    {
        $this->generateAllFeed();
        $this->generateArticlesFeed();
        $this->generateConcertsFeed();
    }

    private function generateAllFeed()
    {
        $articles = Article::query()
            ->where('published_at', '<=', now())
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

        $concerts = Concert::query()
            ->where('published_at', '<=', now())
            ->chunkMap(function (Concert $concert) {
                return new FeedItem(
                    id: $concert->feed_id,
                    title: $concert->title,
                    url: $concert->url,
                    content: $concert->content,
                    updated: $concert->updated_at,
                    published: $concert->published_at,
                );
            });

        $content = [...$articles, ...$concerts];

        dd($content);
    }
}
