<?php

namespace App\Console\Commands;

use App\Actions\GetAllFeedArticles;
use App\Actions\GetAllFeedBlogPosts;
use App\Actions\GetAllFeedConcerts;
use App\Feeds\FeedItem;
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
        $blogPosts = GetAllFeedBlogPosts::make()->execute();

        $content = collect([...$articles, ...$concerts, ...$blogPosts])->sortByDesc('published');

        $this->info('Generating "all" feed...');

        $this->writeFeed(
            fileName: 'all.xml',
            id: route('archive'),
            title: 'Sven Luijten',
            subtitle: 'All of Sven Luijten\'s posts.',
            updated: $content->max('published'),
            author: 'Sven Luijten',
            entries: $content->toArray(),
        );

        $this->info('Generating "articles" feed...');

        $this->writeFeed(
            fileName: 'articles.xml',
            id: route('articles.index'),
            title: 'Sven Luijten - Articles',
            subtitle: 'All of Sven Luijten\'s articles.',
            updated: $articles->max('published'),
            author: 'Sven Luijten',
            entries: $articles->toArray(),
        );

        $this->info('Generating "concerts" feed...');

        $this->writeFeed(
            fileName: 'concerts.xml',
            id: route('concerts.index'),
            title: 'Sven Luijten - Concerts',
            subtitle: 'All of Sven Luijten\'s concerts.',
            updated: $concerts->max('published'),
            author: 'Sven Luijten',
            entries: $concerts->toArray(),
        );

        $this->info('Generating "blog-posts" feed...');

        $this->writeFeed(
            fileName: 'blog-posts.xml',
            id: route('blog.index'),
            title: 'Sven Luijten - Blog Posts',
            subtitle: 'All of Sven Luijten\'s blog posts.',
            updated: $blogPosts->max('published'),
            author: 'Sven Luijten',
            entries: $blogPosts->toArray(),
        );

        $this->info('Successfully generated all feeds.');

        return 0;
    }

    /**
     * @param  array<FeedItem>  $entries
     */
    private function writeFeed(string $fileName, string $id, string $title, string $subtitle, DateTimeInterface $updated, string $author, array $entries): void
    {
        $htmlUrl = match ($fileName) {
            'articles.xml' => route('articles.index'),
            'concerts.xml' => route('concerts.index'),
            'blog-posts.xml' => route('blog.index'),
            'all.xml' => route('archive'),
            default => null,
        };

        $contents = view('feeds.atom', [
            'id' => $id,
            'self' => url('feeds/'.$fileName),
            'html' => $htmlUrl,
            'title' => $title,
            'subtitle' => $subtitle,
            'updated' => $updated,
            'author' => $author,
            'entries' => $entries,
        ])->render();

        $fs = new Filesystem;
        $fs->put(storage_path('feeds/'.$fileName), $contents);
    }
}
