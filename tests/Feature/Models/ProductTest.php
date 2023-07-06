<?php

namespace Tests\Feature\Models;

use App\Models\Image;
use App\Models\Price;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_soft_delete_for_model(): void
    {
        $product = Product::factory()->create();

        $product->delete();

        $this->assertSoftDeleted($product);
    }

    /**
     * @return void
     */
    public function test_relationships_belongs_to_many_product_service(): void
    {
        $product = Product::factory()->create();
        $service = Service::factory()->create();

        $product->services()->sync([$service->id => [
            'price' => 12.22,
            'term_days' => 5
        ]]);

        $this->assertDatabaseHas('products_services', [
            'product_id' => $product->id,
            'service_id' => $service->id
        ]);
    }

    /**
     * @return void
     */
    public function test_relationships_has_one_product_image(): void
    {
        $product = Product::factory()->create();
        $image = Image::factory()->make();

        $product->image()->save($image);

        $this->assertDatabaseHas('images', [
            'product_id' => $product->id
        ]);

        $this->assertDatabaseCount('images', 1);
    }

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

        $this->assertCount(1, $product->prices);
    }
}
