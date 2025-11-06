<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'isbn' => $this->faker->unique()->isbn13(),
            'edition' => $this->faker->numberBetween(1, 4),
            'publication_year' => $this->faker->year(),
            'total_copies' => $this->faker->numberBetween(1, 20),
            'available_copies' => $this->faker->numberBetween(1, 10),
            'manual_sync_flag' => $this->faker->boolean(),
            'category_id' => 2,

        ];
    }
}
