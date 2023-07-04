@props(['product', 'services'])

<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar />
        <div class="p-2 d-flex justify-content-end">
            <a class="btn btn-outline-success" href="{{route('products.services.create', $product->id)}}">Create service</a>
        </div>
        <div class="d-flex m-5 justify-content-around">
            <div>
                <img src="{{url('storage/images/' . $product->image->name)}}" class="img-thumbnail" alt="..." width="300px">
            </div>
            <div>
                <h5>{{$product->name}}</h5>
                <h5>Producer: {{$product->producer}}</h5>
                <h6>{{$product->description}}</h6>
                <h6 class="fw-bold">Price: {{$product->price}}</h6>
            </div>
            <div class="card p-4">
                <h5>Available services</h5>
                <div class="form-check">
                    @foreach($services as $service)
                        <div>
                            <label class="form-check-label" for="{{$service->id}}">
                                {{$service->name}}
                                <br>
                                Price: {{$service->pivot->price}}
                            </label>
                            <input class="form-check-input" type="checkbox" id="{{$service->id}}"
                                   data-service-id="{{$service->id}}" data-service-price="{{$service->pivot->price}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <h3>Full price: <span id="product-price">{{$product->price}}</span></h3>
        </div>
        <script src="/scripts/calculateTotalPrice.js"></script>
    </x-slot>
</x-layout>
