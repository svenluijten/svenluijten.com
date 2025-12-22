<?php

namespace App\Console\Commands;

use App\Actions\AddImagesToMediaCollection;
use App\Actions\ConvertToParsedFile;
use App\Models\Article;
use App\ParsedFile;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ImportMarkdownArticles extends Command
{
    protected $signature = 'app:import-markdown-articles {folder} {--prune}';

    protected $description = 'Import articles from the old JigSaw site into the database.';

    public function handle(): void
    {
        if ($this->option('prune')) {
            Article::query()->delete();

            $this->comment('Pruned all existing articles.');
        }

        $folder = $this->argument('folder');
        $path = storage_path($folder);

        $files = new Filesystem()->allFiles($path);

        $this->info('Importing '.count($files).' articles...');

        collect($files)
            ->map(ConvertToParsedFile::make()->execute(...))
            ->sortBy(fn (ParsedFile $item) => $item->property('date'))
            ->each(function (ParsedFile $item) {
                $article = Article::query()->firstOrCreate(
                    ['slug' => $item->original->getBasename('.md')],
                    [
                        'title' => $item->property('title'),
                        'published_at' => $item->property('date'),
                        'content' => $item->markdown,
                        'created_at' => $item->property('date'),
                        'updated_at' => $item->property('date'),
                    ],
                );

                Article::withoutTimestamps(static function () use ($article) {
                    $article->feedData()->updateOrCreate([], ['identifier' => route('posts.show', $article)]);

                    AddImagesToMediaCollection::make()->execute($article->content, $article, 'article-content', 'posts');
                });
            });

        $this->info('Import complete!');
    }
}
