<?php

namespace Tests\Feature\Models;

use App\Models\Image;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageTest extends TestCase
{

    use RefreshDatabase;


    public function test_relationships_belongs_to_image_product(): void
    {
        $product = Product::factory()->create();
        $image = Image::factory()->make();

        $product->image()->save($image);

        $this->assertDatabaseHas('products', [
            'id' => $image->product->id,
        ]);
    }


}
