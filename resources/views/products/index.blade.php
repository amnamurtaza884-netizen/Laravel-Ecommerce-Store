@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-box-seam"></i> Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add New Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- PRODUCTS GRID -->
    <div class="row mb-5">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                        <p class="card-text fw-bold text-success fs-5">Rs {{ number_format($product->price) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm me-1">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <p>No products found. <a href="{{ route('products.create') }}">Create one now!</a></p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- PAGINATION FOOTER -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
        </ul>
    </nav>

</div>

@endsection