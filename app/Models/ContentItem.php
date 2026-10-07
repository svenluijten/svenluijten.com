<?php

namespace App\Models;

use App\Models\Concerns\HasMarkdownContent;
use App\Models\Concerns\HasUlids;
use App\Models\Scopes\PublishedScope;
use Database\Factories\ContentItemFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[ScopedBy(PublishedScope::class)]
#[UseFactory(ContentItemFactory::class)]
class ContentItem extends Model
{
    use HasFactory;
    use HasUlids;
    use HasMarkdownContent;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'published_at' => 'immutable_datetime',
        ];
    }

    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function feedId(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->feedData->identifier ?? $this->attributes['ulid'],
        );
    }

    public function feedData(): HasOne
    {
        return $this->hasOne(FeedData::class, 'content_item_id', 'id');
    }
}
