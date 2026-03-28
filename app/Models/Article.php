<?php

namespace App\Models;

use App\Models\Concerns\HasFeed;
use App\Models\Concerns\HasMarkdownContent;
use App\Models\Concerns\HasMediaLibrary;
use App\Models\Concerns\HasUlids;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;

class Article extends Model implements HasMedia
{
    use HasMediaLibrary;
    use HasUlids;

    protected $guarded = [];

    public function contentItem(): MorphOne
    {
        return $this->morphOne(ContentItem::class, 'contentable');
    }

    public function getSlugAttribute(): ?string
    {
        return $this->contentItem?->slug;
    }

    public function getTitleAttribute(): ?string
    {
        return $this->contentItem?->title;
    }

    public function getContentAttribute(): ?string
    {
        return $this->contentItem?->content;
    }

    public function getPublishedAtAttribute(): ?string
    {
        return $this->contentItem?->published_at;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getMediaCollection(): string
    {
        return 'article-content';
    }
}
