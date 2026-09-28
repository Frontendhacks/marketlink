@extends('admin.master')
@section('title', 'Orders')
@section('main')
<div class="dashboard-content">
    <div class="page-header">
        <h1>Orders &amp; Payments</h1>
        <p>Track every order, its amount and its status.</p>
    </div>

    @include('admin.partials.flash')

    <div class="stats-grid cols-4">
        <div class="stat-card"><div class="stat-info"><p>Total Orders</p><h2>{{ $stats['total'] }}</h2></div><div class="stat-icon">🛒</div></div>
        <div class="stat-card"><div class="stat-info"><p>Pending</p><h2>{{ $stats['pending'] }}</h2></div><div class="stat-icon">⏳</div></div>
        <div class="stat-card"><div class="stat-info"><p>Completed</p><h2>{{ $stats['completed'] }}</h2></div><div class="stat-icon">✅</div></div>
        <div class="stat-card"><div class="stat-info"><p>Revenue (confirmed + completed)</p><h2>Rs. {{ number_format($stats['revenue'], 2) }}</h2></div><div class="stat-icon">💰</div></div>
    </div>

    <div class="dashboard-card">
        <div class="toolbar">
            <form method="GET" action="{{ route('admin.orders') }}">
                <input type="text" name="q" value="{{ $search }}" placeholder="Order #, customer, product...">
                <select name="status">
                    <option value="">All status</option>
                    @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $opt)<option value="{{ $opt }}" @selected($status === $opt)>{{ ucfirst($opt) }}</option>@endforeach
                </select>
                <button class="btn" type="submit">Filter</button>
                @if($search || $status)<a class="btn light" href="{{ route('admin.orders') }}">Reset</a>@endif
            </form>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead><tr><th>Order</th><th>Customer</th><th>Product / Farmer</th><th>Type</th><th>Qty</th><th>Amount</th><th>Date</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->order_id }}</td>
                        <td>{{ $order->customer->name ?? '—' }}<div class="muted">{{ $order->customer->email ?? '' }}</div></td>
                        <td>{{ $order->product->name ?? '—' }}<div class="muted">{{ $order->product->farmer->name ?? '' }}</div></td>
                        <td>{{ ucfirst($order->order_type ?? 'normal') }}@if($order->pickup_date)<div class="muted">Pickup {{ $order->pickup_date->format('d M Y') }}</div>@endif</td>
                        <td>{{ $order->quantity }}</td>
                        <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ optional($order->order_date)->format('d M Y') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.orders.update', $order->order_id) }}" class="inline-form">
                                @csrf @method('PATCH')
                                <select name="order_status" onchange="this.form.submit()">
                                    @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $opt)<option value="{{ $opt }}" @selected($order->order_status === $opt)>{{ ucfirst($opt) }}</option>@endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.orders.destroy', $order->order_id) }}" data-confirm="Delete order #{{ $order->order_id }}?">@csrf @method('DELETE')<button class="btn sm danger">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="empty">No orders found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @include('admin.partials.pagination', ['paginator' => $orders])
    </div>
</div>
@endsection
