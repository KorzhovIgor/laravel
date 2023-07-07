<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceForProductRequest;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param Product $product
     * @return View
     */
    public function create(Product $product): View
    {
        $services = Service::all();
        return view('services.create', compact('services', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreServiceForProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(StoreServiceForProductRequest $request, Product $product): RedirectResponse
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
}
