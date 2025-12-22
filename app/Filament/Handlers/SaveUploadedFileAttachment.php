<?php

namespace App\Filament\Handlers;

use Filament\Schemas\Components\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

readonly class SaveUploadedFileAttachment
{
    public function __construct(
        private string $mediaCollection,
    ) {}

    public function __invoke(Component $component, TemporaryUploadedFile $file): ?string
    {
        /** @var \App\Models\Article|null $record */
        $record = $component->getRecord();

        if (! $record) {
            return null;
        }

        $media = $record->addMedia($file)
            ->usingFileName(Str::ulid().'.jpg')
            ->toMediaCollection($this->mediaCollection);

        return $media->getUrl();
    }
}
