<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasUlids;

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['ulid'];
    }
}
