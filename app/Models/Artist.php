<?php

namespace App\Models;

use App\Models\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    use HasUlids;

    protected $guarded = [];

    public function records(): BelongsToMany
    {
        return $this->belongsToMany(Record::class);
    }
}
