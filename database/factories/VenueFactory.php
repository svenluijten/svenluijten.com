<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company().' '.$this->faker->randomElement(['Arena', 'Hall', 'Theatre', 'Club', 'Stadium']),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
        ];
    }
}
