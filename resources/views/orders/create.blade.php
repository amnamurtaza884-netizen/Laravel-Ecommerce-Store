@extends('layouts.app')

@section('content')

<div class="container">

    <h3>Place Order</h3>

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product Name">

        <input type="number" name="quantity" class="form-control mb-2" placeholder="Quantity">

        <button class="btn btn-success">Place Order</button>
    </form>

</div>

@endsection