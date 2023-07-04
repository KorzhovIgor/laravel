@props(['product'])
<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar />
        <form class="container w-50 mt-5 card p-5" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="text-center">Product form</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Product name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{$product->name}}">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="producer" class="form-label">Producer</label>
                <input name="producer" type="text" class="form-control" id="producer" value="{{$product->producer}}">
            </div>
            @error('producer')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <div class="form-floating">
                    <textarea name="description" class="form-control" placeholder="Leave a description here" id="description"
                              style="height: 100px">{{$product->description}}</textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input name="price" type="text" class="form-control" id="price" pattern="^\d*(\.\d{0,2})?$"
                       placeholder="12.22" value="{{$product->price}}">
            </div>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <img src="{{url('storage/images/' . $product->image->name)}}" width="400px" alt="image wasnt found" />
            <p>If you want to change image plz select this image!</p>
            <div class="mb-3">
                <label for="image" class="form-label">Choose file for product</label>
                <input name="image" class="form-control" type="file" id="image" value="{{url('storage/images/' . $product->image->name)}}" />
            </div>
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-slot>
</x-layout>
