<?php

namespace App\Console\Commands;

use App\Actions\AddImagesToMediaCollection;
use App\Actions\ReplaceImageReferences;
use App\Models\Artist;
use App\Models\Concert;
use App\Models\Venue;
use Carbon\CarbonImmutable;
use DB;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

class ImportMarkdownConcerts extends Command
{
    protected $signature = 'app:import-markdown-concerts {folder} {--prune}';

    protected $description = 'Import concerts from the old JigSaw site into the database.';

    public function handle(): void
    {
        if ($this->option('prune')) {
            DB::table('artist_concert')->delete();

            Venue::query()->delete();
            Artist::query()->delete();
            Concert::query()->delete();

            $this->comment('Pruned all existing concerts, artists and venues.');
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

            /** @var \App\Models\Concert $concert */
            $concert = Concert::create([
                'title' => $fm['title'],
                'date' => $date = CarbonImmutable::parse($fm['date']),
                // 'location' => $fm['location'],
                'published_at' => $date,
                'content' => $contents->getContent(),
                'tour_name' => Str::after($fm['title'], ': '),
                'slug' => $file->getBasename('.md'),
            ]);

            $artists = Str::before($fm['title'], ': ');
            $artists = explode('&', $artists);
            $artists = array_map('trim', $artists);
            $artists = array_filter($artists);
            $artists = array_map(fn (string $name) => Artist::firstOrCreate(['name' => $name]), $artists);

            $concert->mainArtists()->syncWithPivotValues($artists, ['position' => 'main']);

            AddImagesToMediaCollection::make()->execute($file->getContents(), $concert, 'concert-content', 'concerts');
            ReplaceImageReferences::make()->execute($concert);
        }
    }
}
