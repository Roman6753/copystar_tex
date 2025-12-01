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
            'name' => fake()->words(),
            'price' => fake()->numberBetween(1000,10000),
            'category_id' => fake()->numberBetween(36,43),
            'country_id' => fake()->numberBetween(1,193),
            'description' => fake()->paragraph(),
            'image' => asset('/storage/products/1.jpg'),
            'count' => fake()->numberBetween(1,10),
        ];
    }
}
