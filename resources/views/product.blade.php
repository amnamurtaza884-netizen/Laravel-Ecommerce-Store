@extends('layouts.app')

@section('content')

<div class="container">

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/shop">Shop</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">

        <!-- PRODUCT IMAGE -->
        <div class="col-md-6">
            <div class="card shadow">
                <img src="{{ asset('images/'.$product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="max-height: 500px; object-fit: contain;">
            </div>

            <!-- PRODUCT FEATURES -->
            <div class="mt-3">
                <div class="row text-center">
                    <div class="col-4">
                        <i class="bi bi-truck text-primary" style="font-size: 2rem;"></i>
                        <p class="small mt-1">Free Delivery</p>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-arrow-clockwise text-success" style="font-size: 2rem;"></i>
                        <p class="small mt-1">30 Day Returns</p>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-shield-check text-warning" style="font-size: 2rem;"></i>
                        <p class="small mt-1">2 Year Warranty</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUCT DETAILS -->
        <div class="col-md-6">

            <h1 class="mb-3">{{ $product->name }}</h1>

            <!-- PRICE -->
            <h3 class="text-success fw-bold mb-3">Rs {{ number_format($product->price, 2) }}</h3>

            <!-- RATING -->
            <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="text-muted ms-2">(4.5/5 - 127 reviews)</span>
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4">
                <h5>Description</h5>
                <p class="text-muted">{{ $product->description }}</p>
            </div>

            <!-- QUANTITY SELECTOR -->
            <div class="mb-4">
                <label class="form-label fw-bold">Quantity</label>
                <div class="input-group" style="width: 150px;">
                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQty()">-</button>
                    <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="10">
                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQty()">+</button>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="mb-4">
                <!-- ADD TO CART FORM -->
                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="d-inline-block me-2">
                    @csrf
                    <input type="hidden" name="quantity" id="cart_quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>

                <!-- BUY NOW -->
                <a href="{{ route('checkout', $product->id) }}?qty=1" id="buyNowBtn" class="btn btn-success btn-lg">
                    <i class="bi bi-lightning"></i> Buy Now
                </a>
            </div>

            <!-- PRODUCT INFO -->
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title"><i class="bi bi-info-circle"></i> Product Information</h6>
                    <ul class="list-unstyled small">
                        <li><strong>SKU:</strong> PROD-{{ $product->id }}</li>
                        <li><strong>Category:</strong> Electronics</li>
                        <li><strong>Availability:</strong> <span class="text-success">In Stock</span></li>
                        <li><strong>Shipping:</strong> Free delivery on orders over Rs 500</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

    <!-- BACK TO SHOP -->
    <div class="text-center mt-4">
        <a href="/shop" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Shop
        </a>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.getElementById('quantity');
    var cartQuantityInput = document.getElementById('cart_quantity');
    var buyNowBtn = document.getElementById('buyNowBtn');

    function updateBuyNowLink() {
        var qty = parseInt(quantityInput.value) || 1;
        cartQuantityInput.value = qty;
        var baseUrl = buyNowBtn.getAttribute('href').split('?')[0];
        buyNowBtn.setAttribute('href', baseUrl + '?qty=' + qty);
    }

    function incrementQty() {
        var qty = parseInt(quantityInput.value) || 1;
        if (qty < 10) {
            quantityInput.value = qty + 1;
            updateBuyNowLink();
        }
    }

    function decrementQty() {
        var qty = parseInt(quantityInput.value) || 1;
        if (qty > 1) {
            quantityInput.value = qty - 1;
            updateBuyNowLink();
        }
    }

    window.incrementQty = incrementQty;
    window.decrementQty = decrementQty;

    quantityInput.addEventListener('change', updateBuyNowLink);
    updateBuyNowLink();
});
</script>
@endpush
