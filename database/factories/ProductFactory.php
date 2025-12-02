<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(3),
            'category_id' => fake()->numberBetween(1,10),
            'description' => fake()->paragraph(),
            'count' => fake()->numberBetween(1,10),
            'price' => fake()->numberBetween(1000,10000),
            'country_id' => fake()->numberBetween(1,193),
            // 'image' => '/storage/products/1.png',
        ];
    }
}
