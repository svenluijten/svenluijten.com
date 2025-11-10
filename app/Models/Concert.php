<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Concert extends Model
{
    use HasUlids;

    protected $guarded = [];

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
}
