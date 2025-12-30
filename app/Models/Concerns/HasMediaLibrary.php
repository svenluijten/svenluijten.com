<?php

namespace App\Models\Concerns;

use Spatie\MediaLibrary\InteractsWithMedia;

trait HasMediaLibrary
{
    use InteractsWithMedia;

    abstract public function getMediaCollection(): string;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection($this->getMediaCollection())
            ->useDisk(config('filesystems.media'));
    }
}
