<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concert>
 */
class ConcertFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->unique()->sentence(3),
            'slug' => Str::slug($title),
            'tour_name' => Str::title($this->faker->words(3, true)).' Tour',
            'date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'content' => $this->faker->paragraphs(5, true),
            'venue_id' => VenueFactory::new(),
            'published_at' => $this->faker->boolean(90) ? $this->faker->dateTimeBetween('-5 year', '+1 week') : null,
        ];
    }
}
