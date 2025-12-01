<?php

namespace App\Actions;

use App\Makeable;
use App\Models\Concert;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ReplaceImageReferences
{
    use Makeable;

    public function execute(HasMedia&Model $model)
    {
        preg_match_all('/<img\s+[^>]*src="([^"]+)"[^>]*>/i', $model->content,$matches);

        foreach ($matches[1] as $key => $imgPath) {
            $path = basename($imgPath);

            /** @var Media $media */
            $media = $model->media()->where('file_name', $path)->first();

            $newContent = str_replace($matches[0][$key], '<img data-id="'.$media->uuid.'">', $model->content);

            $model->update(['content' => $newContent]);
        }
    }
}
