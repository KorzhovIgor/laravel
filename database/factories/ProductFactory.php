<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => fake()->name,
            'producer' => fake()->company,
            'description' => fake()->text,
            'creation_date' => fake()->date,
            'price' => fake()->randomFloat(2, 0,  100000),
        ];
    }
}
