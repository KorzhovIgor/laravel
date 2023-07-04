@props(['products', 'title'])

<x-layout>
    <x-slot name="title">
        Laravel site
    </x-slot>
    <x-slot name="body">
        <x-navbar />
        <x-searchbar :title="$title" />
        <div class="d-flex flex-wrap w-100 justify-content-around">
            @foreach ($products as $product)
                <x-card :product="$product"/>
            @endforeach
        </div>
    </x-slot>
</x-layout>
