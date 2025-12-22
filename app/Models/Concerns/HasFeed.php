<?php

namespace App\Models\Concerns;

use App\Models\FeedData;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasFeed
{
    public function feedId(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->feedData->identifier ?? $this->attributes['ulid'],
        );
    }

    public function feedData(): MorphOne
    {
        return $this->morphOne(FeedData::class, 'feedable');
    }
}
