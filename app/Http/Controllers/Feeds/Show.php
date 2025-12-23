<?php

namespace App\Http\Controllers\Feeds;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class Show
{
    public function __invoke(string $feed, Filesystem $filesystem): string
    {
        try {
            return $filesystem->get(storage_path("feeds/{$feed}.xml"));
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }
}
