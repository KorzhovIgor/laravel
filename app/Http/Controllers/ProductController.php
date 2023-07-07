<?php

namespace App\Http\Controllers;

use App\Enums\ProducerEnum;
use App\Filters\ProductFilter;
use App\Http\Requests\PutProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Image;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use stdClass;

class ProductController extends Controller
{

    private const LIMIT_RECORDS = 3;

    /**
     * @param ProductFilter $filter
     * @return View
     */
    public function index(ProductFilter $filter): View
    {
        $products = Product::filter($filter)
            ->with('image')
            ->paginate(self::LIMIT_RECORDS)
            ->withQueryString();

        $sorting = [
            (object)['value' => 'asc'],
            (object)['value' => 'desc']
        ];

        return view('products.index', ['products' => $products,
            'producers' => ProducerEnum::cases(), 'sorting' => $sorting]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('products.create', ['producers' => ProducerEnum::cases()]);
    }

    /**
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $productData = $request->validated();
        $price = new Price(['price' => $productData['price']]);
        unset($productData['price']);

        $imageName = storeImage('public/images', $productData['image']);
        unset($productData['image']);

        $product = Product::create($productData);

        $image = new Image(['name' => $imageName]);

        $product->image()->save($image);
        $product->prices()->save($price);

        return redirect()->route('products.index');
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $services = $product->services;

        return view('products.show', compact('product', 'services'));
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * @param PutProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(PutProductRequest $request, Product $product): RedirectResponse
    {
        $productData = $request->validated();
        $price = new Price(['price' => $productData['price']]);
        unset($productData['price']);

        if (isset($productData['image'])) {
            deleteImage('public/images', $product->image->name);
            $product->image()->delete();

            $imageName = storeImage('public/images', $productData['image']);
            $image = new Image();
            $image->name = $imageName;
            $product->image()->save($image);
            unset($productData['image']);
        }
        $product->update($productData);
        $product->prices()->save($price);

        return redirect()->route('products.index');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $imageName = $product->image->name;
        deleteImage('public/images', $imageName);
        $product->delete();

        return redirect()->route('products.index');
    }
}
