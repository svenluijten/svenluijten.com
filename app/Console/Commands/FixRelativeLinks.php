<?php

namespace App\Console\Commands;

use App\Actions\ReplaceRelativeLinksInConcerts;
use App\Models\Concert;
use Illuminate\Console\Command;

class FixRelativeLinks extends Command
{
    protected $signature = 'app:fix-relative-links {concert?}';

    protected $description = 'Fix relative links in concerts.';

    public function handle()
    {
        Concert::query()
            ->when($this->argument('concert'), function ($query) {
                return $query->where('ulid', $this->argument('concert'));
            })
            ->each(ReplaceRelativeLinksInConcerts::make()->execute(...));
    }
}
