<?php

namespace App\Models;

use App\Models\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasUlids;

    protected $guarded = [];
}
