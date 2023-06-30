@props(['services', 'product'])

<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar />
        <form class="container w-50 mt-5 card p-5" action="{{route('products.services.store', $product->id)}}"
              method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center">Service form</h1>
            <div class="mb-3">
                <label for="service_id" class="form-label">Select service</label>
                <select id="service_id" class="form-select" name="service_id">
                    <option selected>Default</option>
                    @foreach($services as $service)
                        <option value="{{$service->id}}" @selected(old('service_id') == $service->id)>
                            {{$service->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('service_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input name="price" type="text" class="form-control" id="price" pattern="^\d*(\.\d{0,2})?$"
                       placeholder="12.22" value="{{old('price')}}">
            </div>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="term_days" class="form-label">Period(days)</label>
                <input name="term_days" type="text" class="form-control" id="term_days" value="{{old('term_days')}}">
            </div>
            @error('period')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-slot>
</x-layout>
