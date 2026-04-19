@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Shopping Cart</h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cartItems) > 0)

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('images/'.$item->product->image) }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px; object-fit: cover;">
                                <strong>{{ $item->product->name }}</strong>
                            </div>
                        </td>
                        <td>Rs {{ $item->product->price }}</td>
                        <td>
                            <span class="badge bg-info">{{ $item->quantity }}</span>
                        </td>
                        <td class="fw-bold">Rs {{ $item->product->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove from cart?')">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                    @php $grandTotal += $item->product->price * $item->quantity; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- TOTAL AND ACTIONS -->
        <div class="row mt-4">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Subtotal:</strong>
                            <strong>Rs {{ $grandTotal }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Tax (0%):</strong>
                            <strong>Rs 0</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6>Total:</h6>
                            <h6 class="text-success">Rs {{ $grandTotal }}</h6>
                        </div>
                        <a href="/checkout/{{ $cartItems->first()->product->id }}?qty={{ $cartItems->first()->quantity }}" class="btn btn-success w-100 mt-3">
                            <i class="bi bi-credit-card"></i> Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTINUE SHOPPING -->
        <div class="mt-4">
            <form method="POST" action="{{ route('cart.clear') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-warning" onclick="return confirm('Clear all items from cart?')">
                    <i class="bi bi-trash"></i> Clear Cart
                </button>
            </form>
            <a href="/shop" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Continue Shopping
            </a>
        </div>

    @else

        <!-- EMPTY CART MESSAGE -->
        <div class="alert alert-info text-center py-5">
            <h4><i class="bi bi-bag-x"></i> Your cart is empty</h4>
            <p>Add some products to your cart to get started!</p>
            <a href="/shop" class="btn btn-primary mt-3">
                <i class="bi bi-shop"></i> Continue Shopping
            </a>
        </div>

    @endif

</div>

@endsection
