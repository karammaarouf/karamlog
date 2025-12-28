<?php

namespace Database\Factories;

use App\Models\ItemDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemDetailFactory extends Factory
{
    protected $model = ItemDetail::class;

    public function definition(): array
    {
        return [
            'width' => $this->faker->numberBetween(10, 100) . ' cm',
            'height' => $this->faker->numberBetween(10, 100) . ' cm',
            'depth' => $this->faker->numberBetween(5, 50) . ' cm',
            'weight' => $this->faker->numberBetween(1, 20) . ' kg',
            'material' => $this->faker->word,
            'color' => $this->faker->safeColorName,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'shape' => $this->faker->word,
            'type' => $this->faker->word,
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'serial_number' => $this->faker->uuid,
            'other_details' => $this->faker->sentence,
        ];
    }
}
