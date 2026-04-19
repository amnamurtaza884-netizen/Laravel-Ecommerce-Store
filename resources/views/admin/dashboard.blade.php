@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- ADMIN HEADER -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="bg-dark text-white p-4 rounded shadow-sm">
                <h1 class="mb-2"><i class="bi bi-speedometer2"></i> Admin Dashboard</h1>
                <p class="text-muted mb-0">Welcome {{ auth()->user()->name ?? 'Admin' }} - Manage your store here</p>
            </div>
        </div>
    </div>

    <!-- STAT CARD ROW -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white shadow h-100">
                <div class="card-body">
                    <h6 class="text-white-50">Total Customers</h6>
                    <h2 class="mb-0">{{ count($customers) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white shadow h-100">
                <div class="card-body">
                    <h6 class="text-white-50">Total Orders</h6>
                    <h2 class="mb-0">{{ count($orders) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark shadow h-100">
                <div class="card-body">
                    <h6 class="text-dark-50">Total Products</h6>
                    <h2 class="mb-0">{{ count($products) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white shadow h-100">
                <div class="card-body">
                    <h6 class="text-white-50">Messages</h6>
                    <h2 class="mb-0">{{ count($customers) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">Products</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">Orders</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="order-items-tab" data-bs-toggle="tab" data-bs-target="#order-items" type="button" role="tab">Order Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="customers-tab" data-bs-toggle="tab" data-bs-target="#customers" type="button" role="tab">Customers</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="admins-tab" data-bs-toggle="tab" data-bs-target="#admins" type="button" role="tab">Admins</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab">Messages</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">

        <!-- PRODUCTS TAB -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <span>Products Management</span>
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-dark">Add Product</a>
                </div>
                <div class="card-body">
                    <table id="productsTable" class="table table-striped table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rs {{ number_format($product->price, 2) }}</td>
                                    <td>{{ substr($product->description, 0, 40) }}...</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ORDERS TAB -->
        <div class="tab-pane fade" id="orders" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">Orders List</div>
                <div class="card-body">
                    <table id="ordersTable" class="table table-striped table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product_name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'shipped' ? 'info' : 'success') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('orders.update', $order->id) }}" class="d-inline">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm d-inline-block w-auto me-1" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this order?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ORDER ITEMS TAB -->
        <div class="tab-pane fade" id="order-items" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">Order Items</div>
                <div class="card-body">
                    <table id="orderItemsTable" class="table table-striped table-hover">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Added At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name ?? 'Guest' }}</td>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- CUSTOMERS TAB -->
        <div class="tab-pane fade" id="customers" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">Customers</div>
                <div class="card-body">
                    <table id="customersTable" class="table table-striped table-hover">
                        <thead class="table-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Orders</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->orders->count() }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ADMINS TAB -->
        <div class="tab-pane fade" id="admins" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-dark text-white">Admins</div>
                <div class="card-body">
                    <table id="adminsTable" class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Orders</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->where('is_admin', true) as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->orders->count() }}</td>
                                    <td>{{ $admin->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- MESSAGES TAB -->
        <div class="tab-pane fade" id="messages" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">Messages</div>
                <div class="card-body">
                    <table id="messagesTable" class="table table-striped table-hover">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->subject }}</td>
                                    <td>{{ substr($customer->message, 0, 50) }}{{ strlen($customer->message) > 50 ? '...' : '' }}</td>
                                    <td>{{ $customer->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#messageModal{{ $customer->id }}">View</button>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete message?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="messageModal{{ $customer->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title">Message from {{ $customer->name }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                                <p><strong>Email:</strong> <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></p>
                                                <p><strong>Subject:</strong> {{ $customer->subject }}</p>
                                                <hr>
                                                <p>{{ $customer->message }}</p>
                                                <hr>
                                                <p class="text-muted"><small>Received: {{ $customer->created_at->format('d-m-Y H:i:s') }}</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#productsTable, #ordersTable, #orderItemsTable, #customersTable, #adminsTable, #messagesTable').DataTable({
        order: [[0, 'desc']],
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        responsive: true
    });
});
</script>
@endpush
