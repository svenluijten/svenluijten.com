<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Concerns\HasUlids as BaseHasUlids;

trait HasUlids
{
    use BaseHasUlids;

    public function uniqueIds(): array
    {
        return ['ulid'];
    }
}
