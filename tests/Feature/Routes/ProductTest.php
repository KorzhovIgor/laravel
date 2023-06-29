<?php

namespace Tests\Feature\Routes;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_get_index_product_view_and_check_product_data(): void
    {
        Product::factory()->has(Image::factory()->count(1))->count(3)->create();

        $response = $this->get('/product');

        $allProducts = Product::with('image')->get();

        $response->assertViewIs('products.index');
        $response->assertViewHas('products', $allProducts);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_create_form_product_view(): void
    {
        $response = $this->get('/product/create');

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
         $this->post('/product', [
             ...$product->attributesToArray(),
            'image' => $file,
        ]);

        $product = Product::where('name', '=', $product->name)->first();

        Storage::assertExists("public/images/{$product->image->name}");

        Storage::delete("public/images/{$product->image->name}");
    }

}
