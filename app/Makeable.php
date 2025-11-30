<?php

namespace App;

trait Makeable
{
    public static function make(): static
    {
        return app(static::class);
    }
}
