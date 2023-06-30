<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar />
        <form class="container w-50 mt-5 card p-5" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center">Product form</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Product name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="producer" class="form-label">Producer</label>
                <input name="producer" type="text" class="form-control" id="producer" value="{{old('producer')}}">
            </div>
            @error('producer')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <div class="form-floating">
                    <textarea name="description" class="form-control" placeholder="Leave a description here" id="description"
                              style="height: 100px">{{old('description')}}</textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            @error('description')
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
                <label for="image" class="form-label">Choose file for product</label>
                <input name="image" class="form-control" type="file" id="image" value="{{old('image')}}">
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
