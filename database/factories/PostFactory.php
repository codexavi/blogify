<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), // Generate a random title
            'content' => $this->faker->paragraph(5), // Generate random content
            'user_id' => \App\Models\User::inRandomOrder()->first()->id, // Randomly assigns a user
        ];
    }
}
