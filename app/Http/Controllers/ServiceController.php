<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceForProductRequest;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        $services = Service::all();
        return view('services.create', compact('services', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceForProductRequest $request, Product $product)
    {
        $serviceData = $request->validated();

        $serviceId = $serviceData['service_id'];
        unset($serviceData['service_id']);

        $servicesIds = $product->services->map(function ($service) {
            return ($service
                ->only(['id']))['id'];
        });

        $product
            ->services()
            ->sync([...$servicesIds, $serviceId => $serviceData]);

        return redirect()->route('products.show', $product->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
