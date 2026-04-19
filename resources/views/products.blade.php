@extends('layouts.app')

@section('content')

<div class="container">
<div class="card p-4">

    <img src="{{ asset('images/'.$product->image) }}" width="200">

    <h2>{{ $product->name }}</h2>
    <h4>Rs {{ $product->price }}</h4>
    <p>{{ $product->description }}</p>

    <a href="{{ route('checkout', $product->id) }}?qty=1" class="btn btn-success">
        Buy Now
    </a>

</div>
</div>
@endsection

@push('scripts')

<script>
$(function () {
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'price'}
        ]
    });
});
</script>

@endpush