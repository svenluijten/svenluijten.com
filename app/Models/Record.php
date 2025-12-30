<?php

namespace App\Models;

use App\MediaFormat;
use App\Models\Concerns\HasUlids;
use Database\Factories\RecordFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[UseFactory(RecordFactory::class)]
class Record extends Model implements HasMedia
{
    use HasUlids;
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion(MediaFormat::Thumbnail->value)
            ->fit(Fit::Crop, 300, 300)
            ->sharpen(10);
    }

    public function thumbnailUrl(): string
    {
        return $this->getFirstMediaUrl('album-cover', MediaFormat::Thumbnail->value);
    }
}
