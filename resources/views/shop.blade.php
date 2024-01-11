@extends("layouts/master")

@section("title","Shop Page")

@section("content")
    <div class="mt-5 d-flex justify-content-between" style="margin: 0 70px;">
        <a href="{{ route('product.create') }}" class="btn button-primary">Add Product</a>
        <form method="POST" action="{{ route('product.search') }}" class="d-flex">
            @csrf
            <input type="search" name="search" class="form-control me-2" placeholder="Search">
            <button type="submit" class="btn button-primary">Search</button>
        </form>
    </div>
    <div class="card-container py-5">
        @if(isset($products) && $products->count() > 0)
            @foreach($products as $product)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <div class="d-flex">
                            <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn button-warning">Edit</a>
                            <form method="POST" action="{{ route('product.destory', ['product' => $product->id]) }}" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn button-danger ms-2">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div style="height: 250px;"><img src="{{ asset('storage/' . $product->image) }}" class="card-img-top px-2" alt="{{$product->name}} Picture"></div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">${{$product->price}}</p>
                        <a href="#" class="btn button-secondary mt-auto" style="width: 103px;">Add to cart</a>
                    </div>
                </div>
            @endforeach
        @else
            <p class="display-6">No products found.</p>
        @endif
    </div>
@endsection