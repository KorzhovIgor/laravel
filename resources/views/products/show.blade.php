@props(['product'])

<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar />
        <div class="p-2 d-flex justify-content-end">
            <a class="btn btn-outline-success" href="{{route('service.create')}}">Create service</a>
        </div>
        <div class="d-flex m-5 justify-content-around">
            <div>
                <img src="{{url('storage/images/' . $product->image->name)}}" class="img-thumbnail" alt="..." width="300px">
            </div>
            <div>
                <h5>{{$product->name}}</h5>
                <h5>Producer: {{$product->producer}}</h5>
                <h6>{{$product->description}}</h6>
            </div>
        </div>
    </x-slot>
</x-layout>
