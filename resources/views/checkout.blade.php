@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 text-center">Secure Checkout</h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-credit-card"></i> Order Summary</h5>
                </div>

                <div class="card-body">

                    <!-- PRODUCT INFO -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <img src="{{ asset('images/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                        </div>
                        <div class="col-md-9">
                            <h4>{{ $product->name }}</h4>
                            <p class="text-muted">{{ substr($product->description, 0, 100) }}...</p>
                            <h5 class="text-success">Rs {{ number_format($product->price, 2) }}</h5>
                        </div>
                    </div>

                    <hr>

                    <!-- ORDER FORM -->
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf

                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- QUANTITY -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Quantity</label>
                            <input type="number" name="quantity" id="orderQuantity" class="form-control" value="{{ old('quantity', $quantity ?? 1) }}" min="1" max="10" required>
                        </div>

                        <!-- DELIVERY ADDRESS -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Enter your full delivery address" required>{{ old('address') }}</textarea>
                        </div>

                        <!-- PHONE NUMBER -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter your phone number" required>
                        </div>

                        <!-- PAYMENT METHOD -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Payment Method</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                                <label class="form-check-label">
                                    <i class="bi bi-cash"></i> Cash on Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="card" disabled>
                                <label class="form-check-label">
                                    <i class="bi bi-credit-card"></i> Credit/Debit Card (Coming Soon)
                                </label>
                            </div>
                        </div>

                        <hr>

                        <!-- ORDER TOTAL -->
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Subtotal:</h5>
                            <h5>Rs <span id="subtotal">{{ number_format($product->price * ($quantity ?? 1), 2) }}</span></h5>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Shipping:</h5>
                            <h5 class="text-success">Free</h5>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <h4>Total:</h4>
                            <h4 class="text-primary">Rs <span id="totalAmount">{{ number_format($product->price * ($quantity ?? 1), 2) }}</span></h4>
                        </div>

                        <!-- PLACE ORDER BUTTON -->
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-check-circle"></i> Place Order
                        </button>

                    </form>

                </div>

            </div>

            <!-- SECURITY INFO -->
            <div class="card mt-3 bg-light">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check text-success" style="font-size: 2rem;"></i>
                    <p class="mb-0 mt-2">Secure checkout with 256-bit SSL encryption</p>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    function updateTotals() {
        var quantity = parseInt(document.getElementById('orderQuantity').value) || 1;
        var price = {{ $product->price }};
        var amount = quantity * price;
        document.getElementById('subtotal').textContent = amount.toFixed(2);
        document.getElementById('totalAmount').textContent = amount.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var quantityInput = document.getElementById('orderQuantity');
        if (quantityInput) {
            quantityInput.addEventListener('input', updateTotals);
            updateTotals();
        }
    });
</script>
@endpush