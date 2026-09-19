<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => Str::title($this->faker->unique()->words($this->faker->numberBetween(1, 3), true)),
        ];
    }
}
