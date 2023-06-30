<?php

namespace Tests\Feature\Models;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{

    use RefreshDatabase;

    public function test_soft_delete_for_model(): void
    {
        $service = Service::factory()->create();

        $service->delete();

        $this->assertSoftDeleted($service);
    }

    public function test_relationships_belongs_to_many_product_service(): void
    {
        $product = Product::factory()->create();
        $service = Service::factory()->create();

        $service->products()->attach($product->id, [
            'price' => 12.21,
            'term_days' => 4,
        ]);

        $this->assertDatabaseHas('products_services', [
            'product_id' => $product->id,
            'service_id' => $service->id
        ]);
    }
}
