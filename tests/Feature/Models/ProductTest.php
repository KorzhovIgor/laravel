<?php

namespace Tests\Feature\Models;

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

    public function test_relationships_belongs_to_many_product_service(): void
    {
        $product = Product::factory()->create();
        $service = Service::factory()->create();

        $product->services()->attach($service->id);

        $this->assertDatabaseHas('product_service', [
            'product_id' => $product->id,
            'service_id' => $service->id
        ]);
    }
}
