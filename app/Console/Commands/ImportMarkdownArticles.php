<?php

namespace App\Console\Commands;

use App\Actions\AddImagesToMediaCollection;
use App\Actions\ReplaceImageReferences;
use App\Models\Article;
use App\Models\Artist;
use App\Models\Concert;
use App\Models\Venue;
use DB;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

class ImportMarkdownArticles extends Command
{
    protected $signature = 'app:import-markdown-articles {folder} {--prune}';

    protected $description = 'Import articles from the old JigSaw site into the database.';

    public function handle(): void
    {
        if ($this->option('prune')) {
            Article::query()
                ->delete()
            ;

            $this->comment('Pruned all existing articles.');
        }

        $folder = $this->argument('folder');
        $path = storage_path($folder);

        $fs = new Filesystem();

        $files = $fs->allFiles($path);

        $environment = new Environment([]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());

        $converter = new MarkdownConverter($environment);

        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($files as $file) {
            $contents = $converter->convert($file->getContents());

            if (!$contents instanceof RenderedContentWithFrontMatter) {
                throw new \InvalidArgumentException(
                    'Could not read Frontmatter from file "'.$file->getRelativePathname().'"'
                );
            }

            $fm = $contents->getFrontMatter();

            $article = Article::query()->firstOrCreate(
                ['slug' => $file->getBasename('.md')],
                [
                    'title' => $fm['title'],
                    'published_at' => $fm['date'],
                    'content' => $contents->getContent(),
                ],
            );

            AddImagesToMediaCollection::make()->execute($file->getContents(), $article, 'article-content', 'posts');
            ReplaceImageReferences::make()->execute($article);
        }
    }
}
