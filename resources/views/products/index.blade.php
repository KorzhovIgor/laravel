@props(['products', 'title', 'producers'])

<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar  />
        <x-searchbar :title="request()->title" />
        <div class="d-flex w-100 p-3">
            <div class="d-flex flex-wrap w-75 justify-content-around">
                @foreach ($products as $product)
                    <x-card :product="$product"/>
                @endforeach
            </div>
            <div class="w-25">
                <div class="card">
                    <form class="card-body" action="{{route('products.index')}}" method="get">
                        <h1 class="text-center">Filtration form</h1>
                        <div class="mb-3">
                            <label for="producer" class="form-label">Producer</label>
                            <x-select name="producer" :options="$producers" id="producer" :oldValue="request()->producer" />
                        </div>
                        <div class="mb-3">
                            <label for="min_price" class="form-label">Min price</label>
                            <input name="min_price" type="text" class="form-control" id="min_price" pattern="^\d*(\.\d{0,2})?$"
                                   placeholder="12.22" value={{request()->min_price}}>
                        </div>
                        <div class="mb-3">
                            <label for="max_price" class="form-label">Max price</label>
                            <input name="max_price" type="text" class="form-control" id="max_price" pattern="^\d*(\.\d{0,2})?$"
                                   placeholder="12.22" value={{request()->max_price}}>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{$products->links()}}
        </div>
    </x-slot>
</x-layout>
