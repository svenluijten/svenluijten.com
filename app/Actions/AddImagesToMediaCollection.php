<?php

namespace App\Actions;

use App\Makeable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AddImagesToMediaCollection
{
    use Makeable;

    public function execute(string $contents, HasMedia $model, string $collectionName, string $imageFolder): void
    {
        preg_match_all('/!\[(.*?)]\((.*?)\)/', $contents, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            [$_, $altText, $imagePath] = $match;

            $imageFullPath = storage_path('old-content/images/'.$imageFolder.'/'.basename($imagePath));

            if (new Filesystem()->missing($imageFullPath)) {
                continue;
            }

            $existing = $model->getMedia($collectionName)
                ->where('file_name', basename($imageFullPath))
                ->first();

            if ($existing) {
                continue;
            }

            $model->addMedia($imageFullPath)
                ->preservingOriginal()
                ->withCustomProperties(['alt' => $altText])
                ->usingFileName($fileName = Str::ulid().'.jpg')
                ->toMediaCollection($collectionName);

            $mediaUrl = Media::query()->where('file_name', $fileName)->first()?->getUrl();

            $model->update(['content' => str_replace($imagePath, $mediaUrl, $model->content)]);
        }
    }
}
