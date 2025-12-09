<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MoveMedia extends Command
{
    protected $signature = 'app:move-media {oldDisk=local} {newDisk=r2}';

    protected $description = 'Move all media files between configured storage disks.';

    public function handle()
    {
        $oldDisk = $this->argument('oldDisk');
        $newDisk = $this->argument('newDisk');

        Media::query()
            ->where('disk', $oldDisk)
            ->each(function (Media $media) use ($oldDisk, $newDisk) {
                Storage::disk($newDisk)->put(
                    $media->getPathRelativeToRoot(),
                    Storage::disk($oldDisk)->get($media->getPathRelativeToRoot())
                );

                foreach ($media->getGeneratedConversions() as $conversionName => $isGenerated) {
                    Storage::disk($oldDisk)->delete($media->getPathRelativeToRoot($conversionName));
                    $media->markAsConversionNotGenerated($conversionName);
                }

                Storage::disk($oldDisk)->delete($media->getPathRelativeToRoot());
                $media->update(['disk' => $newDisk, 'conversions_disk' => $newDisk]);
            });
    }
}
