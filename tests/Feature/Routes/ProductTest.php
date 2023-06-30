<?php

namespace Tests\Feature\Routes;

use App\Models\Image;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_get_index_product_view_and_check_product_data(): void
    {
        $allProducts = Product::factory()->has(Image::factory()->count(1))->count(3)->create();

        $response = $this->get('/products');

        $response->assertViewIs('products.index');
        $response->assertViewHas('products', $allProducts);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_create_form_product_view(): void
    {
        $response = $this->get('/products/create');

        $response->assertViewIs('products.create');
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_store_product(): void
    {
        $file = UploadedFile::fake()->image('avatar.jpg');
        $product = Product::factory()->make();
        unset($product['creation_date']);
        $this->post('/products', [
            ...$product->attributesToArray(),
            'image' => $file,
        ]);

        $product = Product::where('name', '=', $product->name)->first();

        $this->assertModelExists($product);
        Storage::assertExists("public/images/{$product->image->name}");

        Storage::delete("public/images/{$product->image->name}");
    }

    /**
     * @return void
     */
    public function test_get_create_product_view_and_check_product_data(): void
    {
        $product = Product::factory()->has(Image::factory()->count(1))->count(1)->create();

        $response = $this->get("/products/{$product[0]->id}");

        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product[0]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_show_product_view_and_check_product_data_and_services(): void
    {
        $product = Product::factory()->has(Image::factory()->count(1))->create();

        $service = Service::factory()->create();

        $product->services()->sync([$service->id => [
            'price' => 123.12,
            'term_days' => 3,
        ]]);

        $response = $this->get("/products/{$product->id}");

        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product);
        $response->assertStatus(200);
    }
}
