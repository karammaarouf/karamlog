<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'description' => $this->faker->sentence,
            'code' => $this->faker->unique()->numberBetween(1000, 9999),
            'quantity' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
            'discount' => $this->faker->randomFloat(2, 0, 50),
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'updated_at' => now(),
        ];
    }
}
