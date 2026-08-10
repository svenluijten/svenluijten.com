<?php

namespace App\Models\Concerns;

use Spatie\MediaLibrary\InteractsWithMedia;

trait HasMediaLibrary
{
    use InteractsWithMedia;

    abstract public function getMediaCollectionName(): string;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection($this->getMediaCollectionName())
            ->useDisk(config('filesystems.media'));
    }
}
