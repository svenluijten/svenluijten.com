<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia, HasRichContent
{
    use HasUlids;
    use InteractsWithMedia;
    use InteractsWithRichContent;
    use HasFeed;

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'immutable_datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
                    ->collection('article-content')
            )
            ->fileAttachmentsVisibility('public');
    }
}
