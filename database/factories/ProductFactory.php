<?php

namespace Database\Factories;

use App\Enums\ProducerEnum;
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
            'producer' => ProducerEnum::values()[random_int(0, count(ProducerEnum::values()) - 1)],
            'description' => fake()->text,
        ];
    }
}
