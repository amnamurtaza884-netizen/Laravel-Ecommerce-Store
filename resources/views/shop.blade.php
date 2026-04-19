@extends('layouts.app')

@section('content')

<div class="container">

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ERROR MESSAGE -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">

        @foreach($products as $p)
        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">

                <!-- PRODUCT IMAGE -->
                <img src="{{ asset('images/'.$p->image) }}" class="card-img-top" alt="{{ $p->name }}" style="height: 250px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <!-- PRODUCT NAME -->
                    <h5 class="card-title">{{ $p->name }}</h5>

                    <!-- PRODUCT PRICE -->
                    <p class="card-text text-success fw-bold">Rs {{ $p->price }}</p>

                    <!-- PRODUCT DESCRIPTION -->
                    <p class="card-text text-muted small">{{ substr($p->description, 0, 80) }}...</p>

                    <!-- BUTTONS -->
                    <div class="mt-auto">
                        <!-- VIEW BUTTON -->
                        <a href="/product/{{ $p->id }}" class="btn btn-dark btn-sm w-100 mb-2">
                            <i class="bi bi-eye"></i> View Details
                        </a>

                        <!-- ADD TO CART BUTTON -->
                        @if(auth()->check())
                            <form method="POST" action="{{ route('cart.add', $p->id) }}" class="d-inline-block w-100">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm w-100" title="Add to cart">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="/login" class="btn btn-warning btn-sm w-100" title="Login to add to cart">
                                <i class="bi bi-box-arrow-in-right"></i> Login to Buy
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection