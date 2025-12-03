<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FeedData extends Model
{
    protected $guarded = [];

    public function feedable(): MorphTo
    {
        return $this->morphTo();
    }
}
