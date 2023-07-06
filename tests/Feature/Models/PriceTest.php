<?php

namespace Tests\Feature\Models;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceTest extends TestCase
{

    use RefreshDatabase;

    public function test_relationships_one_to_many_prices(): void
    {
        $product = Product::factory()->create();
        $price = Price::factory()->make();

        $product->prices()->save($price);

        $this->assertDatabaseHas('prices', [
            'product_id' => $product->id,
            'price' => $price->price,
            'currency' => $price->currency,
        ]);

        $this->assertEquals($price->price, $product->prices[0]->price);
    }
}
