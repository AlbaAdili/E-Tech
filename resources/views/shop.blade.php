@extends("layouts/master")

@section("title","Shop Page")

@section("content")
    <div class="m-5">
        <a href="{{ route('product.create') }}" class="btn button-primary">Add Product</a>
    </div>
    <div class="card-container py-5">
        @foreach($products as $product)
            <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top px-2" alt="{{$product->name}} Picture">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">${{$product->price}}</p>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-primary">Add to cart</a>
                        <div class="heart-container">
                            <svg class="heart" width="30" height="30" fill="#0c6efd"><use xlink:href="#heart"/></svg>
                            <svg class="heart-fill d-none" width="30" height="30" fill="#0c6efd"><use xlink:href="#heart-fill"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection