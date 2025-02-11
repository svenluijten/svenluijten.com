<?php

namespace App\Events;

use App\Models\Concert;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

readonly class ConcertPublished
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Concert $concert,
    ) {}
}
