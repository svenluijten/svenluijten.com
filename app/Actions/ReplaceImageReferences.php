<?php

namespace App\Actions;

use App\Makeable;
use App\Models\Concert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ReplaceImageReferences
{
    use Makeable;

    public function execute(Concert $concert)
    {
        preg_match_all('/<img\s+[^>]*src="([^"]+)"[^>]*>/i', $concert->content,$matches);

        foreach ($matches[1] as $key => $imgPath) {
            $path = basename($imgPath);

            /** @var Media $media */
            $media = $concert->media()->where('file_name', $path)->first();

            $newContent = str_replace($matches[0][$key], '<img data-id="'.$media->uuid.'">', $concert->content);

            $concert->update(['content' => $newContent]);
        }
    }
}
