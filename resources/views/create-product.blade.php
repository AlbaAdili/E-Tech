@extends("layouts/master")

@section("title","Create Product")

@section("content")
    <div>
        <form method="POST" action="{{ route('product.store') }}" class="form" enctype="multipart/form-data">
            @csrf 
            <div class="form-content">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-content">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" required>
            </div>
            <div class="form-content">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" onchange="updateFileName()">
                <br>
                <button type="button" class="btn button-primary" onclick="document.getElementById('image').click()">Choose File</button>
                <span id="selectedFileName"></span>
            </div>
            <div class="form-content">
                <button type="submit" class="btn button-secondary">Create Product</button>
            </div>
        </form>
    </div>
@endsection