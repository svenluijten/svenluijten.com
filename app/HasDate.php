<?php

namespace App;

use Illuminate\Support\Carbon;

trait HasDate
{
    public function getDate(string $format, string $key = 'date')
    {
        return (new Carbon($this->{$key}))->format($format);
    }
}
