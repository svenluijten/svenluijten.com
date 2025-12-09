<?php

namespace App\Models;

use App\MediaFormat;
use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Concert extends Model implements HasMedia, HasRichContent
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'immutable_datetime',
            'date' => 'immutable_date',
        ];
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('concerts.show', [
                'date' => $this->date->format('Y-m-d'),
                'concert' => $this->slug,
            ])
        );
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }

    public function mainArtists(): BelongsToMany
    {
        return $this->artists()
            ->withPivot('position')
            ->wherePivot('position', 'main');
    }

    public function supportArtists(): BelongsToMany
    {
        return $this->artists()
            ->withPivot('position')
            ->wherePivot('position', 'support');
    }

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
                    ->collection('concert-content')
            )
            ->fileAttachmentsVisibility('public');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion(MediaFormat::Thumbnail->value)
            ->fit(Fit::Crop, 180, 180)
            ->sharpen(10);
    }

    public function thumbnailUrl(): string
    {
        return $this->getFirstMediaUrl('concert-content', MediaFormat::Thumbnail->value);
    }
}
