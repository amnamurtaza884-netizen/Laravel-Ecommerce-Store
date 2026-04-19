@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 text-center">Add Product</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow p-4">

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label>Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Button -->
                    <button class="btn btn-success w-100">
                        Save Product
                    </button>

                </form>

            </div>

        </div>
    </div>

</div>

@endsection