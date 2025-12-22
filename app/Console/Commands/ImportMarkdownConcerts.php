<?php

namespace App\Console\Commands;

use App\Actions\AddImagesToMediaCollection;
use App\Actions\ConvertToParsedFile;
use App\Actions\ReplaceRelativeLinksInConcerts;
use App\Models\Artist;
use App\Models\Concert;
use App\Models\Venue;
use App\ParsedFile;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImportMarkdownConcerts extends Command
{
    protected $signature = 'app:import-markdown-concerts {folder} {--prune}';

    protected $description = 'Import concerts from the old JigSaw site into the database.';

    public function handle(): void
    {
        if ($this->option('prune')) {
            DB::table('artist_concert')->delete();

            Artist::query()->delete();
            Concert::query()->delete();
            Venue::query()->delete();

            Media::query()->where('collection_name', 'concert-content')->delete();

            $this->comment('Pruned all existing concerts, artists and venues.');
        }

        $folder = $this->argument('folder');
        $path = storage_path($folder);

        $files = new Filesystem()->allFiles($path);

        $this->info('Importing '.count($files).' concerts...');

        collect($files)
            ->map(ConvertToParsedFile::make()->execute(...))
            ->sortBy(fn (ParsedFile $item) => $item->property('date'))
            ->each(function (ParsedFile $item): void {
                $concert = Concert::query()->create([
                    'title' => $item->property('title'),
                    'date' => $item->property('date'),
                    'published_at' => $item->property('date'),
                    'content' => $item->markdown,
                    'tour_name' => Str::after($item->property('title'), ': '),
                    'slug' => $item->original->getBasename('.md'),
                    'created_at' => $item->property('date'),
                    'updated_at' => $item->property('date'),
                ]);

                $artists = $this->getArtistsFromTitle($item->property('title'));

                Concert::withoutTimestamps(static function () use ($concert, $artists) {
                    $concert->mainArtists()->syncWithPivotValues($artists, ['position' => 'main']);

                    $concert->feedData()->updateOrCreate([], ['identifier' => $concert->url]);

                    AddImagesToMediaCollection::make()->execute($concert->content, $concert, 'concert-content', 'concerts');
                    ReplaceRelativeLinksInConcerts::make()->execute($concert);
                });
            })
            ->toArray();

        $this->info('Import complete!');
    }

    private function getArtistsFromTitle(string $title): array
    {
        $artists = Str::before($title, ': ');
        $artists = explode('&', $artists);
        $artists = array_map('trim', $artists);
        $artists = array_filter($artists);

        return array_map(static fn (string $name) => Artist::firstOrCreate(['name' => $name]), $artists);
    }
}
