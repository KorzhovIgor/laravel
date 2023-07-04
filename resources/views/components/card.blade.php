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
        <h6 class="card-title fw-bold">Price: {{$product->price}}</h6>
        <a href="{{route('products.show', $product->id)}}" class="btn btn-primary">Open</a>
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('products.edit', $product->id)}}">Update</a></li>
                <li>
                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item">Delete</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
