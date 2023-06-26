<div class="card w-25 border-box m-3">
    <img src="{{url('storage/images/' . $product->image->name)}}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <h6 class="card-title fw-bold">Producer: {{$product->producer}}</h6>
        <p class="card-text">
            {{strlen($product->description) > 64 ?
                substr($product->description, 0, 64) :
                $product->description
            }}
        </p>
        <a href="{{route('product.show', $product->id)}}" class="btn btn-primary">Open</a>
    </div>
</div>
