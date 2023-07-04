<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPutRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Image;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $title = $request->title;

        $allProducts = Product::query()
            ->when($title, function (Builder $query, $title) {
                $query->where('products.name', 'like', "{$title}%");
            })
            ->with('image')
            ->get();

        return view('products.index', ['products' => $allProducts, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $productData = $request->validated();
        $imageName = storeImage('public/images', $productData['image']);
        unset($productData['image']);
        $product = Product::create([
            ...$productData,
            'creation_date' => Carbon::now(),
        ]);

        $image = new Image();
        $image->name = $imageName;

        $product->image()->save($image);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $services = $product->services;

        return view('products.show', compact('product', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductPutRequest $request, Product $product): RedirectResponse
    {
        $productData = $request->validated();

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

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): View
    {
        $imageName = $product->image->name;
        deleteImage('public/images', $imageName);
        $product->delete();

        return view('products.index');
    }
}
