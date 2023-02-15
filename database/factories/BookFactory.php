<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(random_int(3,10)),
            'isbn' => fake()->isbn13(),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'genre' => ucfirst(fake()->word()),
            'image' => fake()->imageUrl(),
            'description' => fake()->text(),
            'published' => now()->subDays(random_int(1,30)),
        ];
    }
}
