<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // tinker
        // App\Models\Post::factory()->times(100)->create('user_id' => 4);
        return [
            'body' => $this->faker->sentence(20),
        ];
    }
}
