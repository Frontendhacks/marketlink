@extends('admin.master')
@section('title','Farmer Details')
@section('main')
<div class="dashboard-content">
<div class="page-header"><h1>{{ $user->name }}</h1><p>{{ $user->farmerProfile->stall_name ?? 'Farmer' }} · {{ $user->email }}</p></div>
@include('admin.partials.flash')
<div class="dashboard-card">
    <div class="card-header">
        <h3>Registration &amp; Approval <span class="badge {{ $user->approval_status }}">{{ ucfirst($user->approval_status) }}</span></h3>
        <div class="row-actions">
            @if(in_array($user->approval_status, ['pending', 'rejected', 'inactive'], true))
                <form method="POST" action="{{ route('admin.farmers.approve', $user) }}">@csrf<button class="btn">{{ $user->approval_status === 'pending' ? 'Approve Farmer' : 'Re-approve' }}</button></form>
            @endif
            @if($user->approval_status === 'pending')
                <form method="POST" action="{{ route('admin.farmers.reject', $user) }}" data-confirm="Reject this registration?">@csrf<button class="btn warning">Reject</button></form>
            @endif
            @if($user->approval_status === 'approved')
                <form method="POST" action="{{ route('admin.farmers.deactivate', $user) }}" data-confirm="Deactivate this farmer?">@csrf<button class="btn warning">Deactivate</button></form>
            @endif
            <a class="btn secondary" href="{{ route('admin.farmers') }}">Back</a>
        </div>
    </div>
    <div class="detail-list">
        <p><b>Email:</b> {{ $user->email }}</p>
        <p><b>Phone:</b> {{ $user->contact ?: '—' }}</p>
        <p><b>Address:</b> {{ $user->address ?: '—' }}</p>
        <p><b>Farm:</b> {{ $user->farmerProfile->stall_name ?? '—' }}</p>
        <p><b>Type:</b> {{ $user->farmerProfile->farm_type ?? '—' }}</p>
        <p><b>Size:</b> {{ $user->farmerProfile->farm_size ?? '—' }}</p>
        <p><b>City:</b> {{ $user->farmerProfile->city ?? '—' }}</p>
        <p><b>Market:</b> {{ $user->farmerProfile->market->market_name ?? '—' }}</p>
        <p><b>Registered:</b> {{ $user->created_at?->format('d M Y H:i') }}</p>
    </div>
</div>
<div class="dashboard-card"><h3>Farmer Products</h3><div class="table-container"><table class="orders-table"><thead><tr><th>Product</th><th>Category</th><th>Market</th><th>Price</th><th>Stock</th></tr></thead><tbody>@forelse($user->products as $product)<tr><td>{{ $product->name }}</td><td>{{ $product->category->name ?? '—' }}</td><td>{{ $product->market->market_name ?? '—' }}</td><td>Rs. {{ number_format($product->price,2) }}</td><td>{{ $product->stock_quantity }}</td></tr>@empty<tr><td colspan="5">No products.</td></tr>@endforelse</tbody></table></div></div>
<div class="dashboard-card"><h3>Farmer Orders</h3><div class="table-container"><table class="orders-table"><thead><tr><th>ID</th><th>Customer</th><th>Product</th><th>Qty</th><th>Total</th><th>Status</th></tr></thead><tbody>@forelse($orders as $order)<tr><td>#{{ $order->order_id }}</td><td>{{ $order->customer->name ?? '—' }}</td><td>{{ $order->product->name ?? '—' }}</td><td>{{ $order->quantity }}</td><td>Rs. {{ number_format($order->total_amount,2) }}</td><td>{{ ucfirst($order->order_status) }}</td></tr>@empty<tr><td colspan="6">No orders.</td></tr>@endforelse</tbody></table></div></div>
</div>
@endsection
