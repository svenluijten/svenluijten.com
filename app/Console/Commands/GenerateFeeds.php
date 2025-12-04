<?php

namespace App\Console\Commands;

use App\Actions\GetAllFeedArticles;
use App\Actions\GetAllFeedConcerts;
use App\Feeds\FeedItem;
use App\Models\Article;
use App\Models\Concert;
use DateTimeInterface;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateFeeds extends Command
{
    protected $signature = 'app:generate-feeds';

    protected $description = '(Re)generate the Atom and JSON feeds.';

    public function handle()
    {
        $articles = GetAllFeedArticles::make()->execute();
        $concerts = GetAllFeedConcerts::make()->execute();

        $content = collect([...$articles, ...$concerts])->sortByDesc('published');

        $this->writeFeed(
            fileName: 'all.xml',
            id: 'https://svenluijten.com/archive',
            title: 'Sven Luijten',
            subtitle: 'All of Sven Luijten\'s posts.',
            updated: $content->max('updated'),
            author: 'Sven Luijten',
            entries: $content->toArray(),
        );

        $this->writeFeed(
            fileName: 'articles.xml',
            id: route('articles.index'),
            title: 'Sven Luijten - Articles',
            subtitle: 'All of Sven Luijten\'s articles.',
            updated: $articles->max('updated'),
            author: 'Sven Luijten',
            entries: $articles->toArray(),
        );

        $this->writeFeed(
            fileName: 'concerts.xml',
            id: route('concerts.index'),
            title: 'Sven Luijten - Concerts',
            subtitle: 'All of Sven Luijten\'s concerts.',
            updated: $concerts->max('updated'),
            author: 'Sven Luijten',
            entries: $concerts->toArray(),
        );
    }

    /**
     * @param array<FeedItem> $entries
     */
    private function writeFeed(string $fileName, string $id, string $title, string $subtitle, DateTimeInterface $updated, string $author, array $entries): void
    {
        $contents = view('feeds.atom', [
            'id' => $id,
            'title' => $title,
            'subtitle' => $subtitle,
            'updated' => $updated,
            'author' => $author,
            'entries' => $entries,
        ])->render();

        $fs = new Filesystem();
        $fs->put(public_path('feeds/'.$fileName), $contents);
    }
}
