@extends('admin.master')
@section('title','Customer Details')
@section('main')
<div class="dashboard-content">
@include('admin.partials.flash')
<div class="page-header"><h1>{{ $user->name }}</h1><p>{{ $user->email }}</p></div>
<div class="dashboard-card"><form method="POST" action="{{ route('admin.customers.update',$user) }}" class="row g-3">@csrf @method('PUT')<div class="col-md-6"><label>Name</label><input class="form-control" name="name" value="{{ $user->name }}" required></div><div class="col-md-6"><label>Email</label><input class="form-control" name="email" value="{{ $user->email }}" required></div><div class="col-md-6"><label>Contact</label><input class="form-control" name="contact" value="{{ $user->contact }}"></div><div class="col-md-6"><label>Address</label><input class="form-control" name="address" value="{{ $user->address }}"></div><div class="col-md-4"><label>Status</label><select class="form-select" name="status"><option value="active" @selected($user->status==='active')>Active</option><option value="suspended" @selected($user->status==='suspended')>Suspended</option></select></div><div class="col-12"><button class="btn btn-primary">Save Changes</button> <a class="btn btn-secondary" href="{{ route('admin.customers') }}">Back</a></div></form></div>
<div class="dashboard-card"><h3>Customer Orders</h3><div class="table-container"><table class="orders-table"><thead><tr><th>ID</th><th>Product</th><th>Farmer</th><th>Qty</th><th>Total</th><th>Status</th></tr></thead><tbody>@forelse($user->orders as $order)<tr><td>#{{ $order->order_id }}</td><td>{{ $order->product->name ?? '—' }}</td><td>{{ $order->product->farmer->name ?? '—' }}</td><td>{{ $order->quantity }}</td><td>Rs. {{ number_format($order->total_amount,2) }}</td><td>{{ ucfirst($order->order_status) }}</td></tr>@empty<tr><td colspan="6">No orders.</td></tr>@endforelse</tbody></table></div></div>
</div>
@endsection
