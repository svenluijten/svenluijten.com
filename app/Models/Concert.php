<?php

namespace App\Models;

use App\MediaFormat;
use App\Models\Concerns\HasFeed;
use App\Models\Concerns\HasMarkdownContent;
use App\Models\Concerns\HasMediaLibrary;
use App\Models\Concerns\HasUlids;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[ScopedBy(PublishedScope::class)]
class Concert extends Model implements HasMedia
{
    use HasFeed;
    use HasMarkdownContent;
    use HasMediaLibrary;
    use HasUlids;

    protected $guarded = [];

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

    public function getMediaCollection(): string
    {
        return 'concert-content';
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
