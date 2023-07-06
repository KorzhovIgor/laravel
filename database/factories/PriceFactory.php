<?php

namespace Database\Factories;

use App\Enums\CurrencyEnum;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => fake()->randomFloat(2, 0, 1000),
            'currency' => CurrencyEnum::values()[random_int(0, count(CurrencyEnum::values()) - 1)],

        ];
    }
}
