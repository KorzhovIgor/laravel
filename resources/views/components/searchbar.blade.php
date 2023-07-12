<nav class="navbar bg-body-tertiary">
    <div class="container-fluid justify-content-between">
        <form class="d-flex" role="search" action="{{route('products.index')}}" method="GET">
            <input name="title" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{$title}}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div>
            <a class="btn btn-outline-success" href="{{route('products.create')}}">Create product</a>
            <a class="btn btn-outline-success" href="{{route('db-export')}}">Export data</a>
        </div>
    </div>
</nav>
