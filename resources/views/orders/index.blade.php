@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 text-center">Orders Management</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover" id="ordersTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>

@endsection

@push('scripts')

<script>
$(function () {

    $('#ordersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('orders') }}",

        columns: [
            { data: 'id', name: 'id' },
            { data: 'product_name', name: 'product_name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'status', name: 'status' },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

});
</script>

@endpush