@extends("layouts/master")

@section("title","Shop Page")

@section("content")
    <div class="mt-5" style="margin-left: 70px;">
        <a href="{{ route('product.create') }}" class="btn button-primary">Add Product</a>
    </div>
    <div class="card-container py-5">
        @foreach($products as $product)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <div class="d-flex">
                        <a href="#" class="btn button-warning">Edit</a>
                        <a href="#" class="btn button-danger ms-2">Delete</a>
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
    </div>
@endsection