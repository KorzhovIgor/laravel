<?php

namespace Tests\Feature\Routes;

use App\Models\Image;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_get_create_form_service_view(): void
    {
        $product = Product::factory()->has(Image::factory()->count(1))->create();
        $services = Service::factory()->count(2)->create();

        $response = $this->get("/products/{$product->id}/services/create");

        $response->assertViewIs('services.create');
        $response->assertViewHas('product', $product);
        $response->assertViewHas('services', $services);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_store_service(): void
    {
        $product = Product::factory()->has(Image::factory()->count(1))->create();
        $service = Service::factory()->create();

        $this->post("products/{$product->id}/services", [
            'service_id' => $service->id,
            'price' => 12.21,
            'term_days' => 7,
        ]);

        $this->assertDatabaseCount('products_services', 1);
    }
}
