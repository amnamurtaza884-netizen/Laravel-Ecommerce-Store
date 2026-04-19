@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-6">
        <img src="{{ $product->image }}" class="img-fluid">
    </div>

    <div class="col-md-6">
        <h2>{{ $product->name }}</h2>
        <h4>{{ $product->price }} PKR</h4>
        <p>{{ $product->description }}</p>

        <a href="{{ route('checkout', $product->id) }}?qty=1" class="btn btn-success">Buy Now</a>
    </div>

</div>

@endsection