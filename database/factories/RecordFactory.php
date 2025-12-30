<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'comment' => $this->faker->boolean(10) ? $this->faker->paragraph() : null,
            'discogs_release_code' => $this->faker->boolean(30) ? $this->faker->bothify('r#??#?#?###??') : null,
        ];
    }
}
