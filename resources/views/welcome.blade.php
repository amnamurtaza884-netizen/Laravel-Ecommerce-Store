@extends('layouts.app')

@section('content')

<!-- HERO SLIDER -->
<div id="carouselExample" class="carousel slide mb-5" data-bs-ride="carousel">

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
                 class="d-block w-100" style="height:400px; object-fit:cover;" alt="Product 1">
        </div>

        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a"
                 class="d-block w-100" style="height:400px; object-fit:cover;" alt="Product 2">
        </div>

        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e"
                 class="d-block w-100" style="height:400px; object-fit:cover;" alt="Product 3">
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

</div>

<!-- WELCOME CONTENT -->
<div class="text-center mb-5">
    <h1 class="display-4 fw-bold text-primary">Welcome to Ecommerce Store</h1>
    <p class="lead text-muted">Best Online Shopping System - Quality Products at Great Prices</p>
    <a href="/shop" class="btn btn-primary btn-lg mt-3">
        <i class="bi bi-shop"></i> Start Shopping
    </a>
</div>

<!-- FEATURED PRODUCTS PREVIEW -->
<div class="row text-center">
    <div class="col-md-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <i class="bi bi-truck text-primary" style="font-size: 3rem;"></i>
                <h5 class="card-title mt-3">Fast Delivery</h5>
                <p class="card-text">Quick and reliable shipping to your doorstep</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <i class="bi bi-shield-check text-success" style="font-size: 3rem;"></i>
                <h5 class="card-title mt-3">Secure Payment</h5>
                <p class="card-text">Safe and secure payment methods</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <i class="bi bi-headset text-warning" style="font-size: 3rem;"></i>
                <h5 class="card-title mt-3">24/7 Support</h5>
                <p class="card-text">Customer support available round the clock</p>
            </div>
        </div>
    </div>
</div>

@endsection