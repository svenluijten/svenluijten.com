<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence(),
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(5, true),
            'published_at' => $this->faker->boolean(90) ? $this->faker->dateTimeBetween('-5 year', '+1 week') : null,
        ];
    }
}
