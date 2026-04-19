@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 text-center">Edit Product</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow p-4">

                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    </div>

                    <!-- Current Image -->
                    <div class="mb-3">
                        <label>Current Image</label>
                        <br>
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px;">
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label>Change Product Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Button -->
                    <button class="btn btn-success w-100">
                        Update Product
                    </button>

                </form>

            </div>

        </div>
    </div>

</div>

@endsection