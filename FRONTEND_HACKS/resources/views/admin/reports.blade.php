@extends('admin.master')
@section('title', 'Reports')
@section('main')
<div class="dashboard-content">
    <div class="page-header">
        <h1>Reports</h1>
        <p>Live figures calculated from the MarketLink database.</p>
    </div>

    <div class="stats-grid cols-4">
        <div class="stat-card"><div class="stat-info"><p>Total Revenue</p><h2>Rs. {{ number_format($totalRevenue, 2) }}</h2></div><div class="stat-icon">💰</div></div>
        <div class="stat-card"><div class="stat-info"><p>Total Orders</p><h2>{{ $totalOrders }}</h2></div><div class="stat-icon">🛒</div></div>
        <div class="stat-card"><div class="stat-info"><p>Customers</p><h2>{{ $totalCustomers }}</h2></div><div class="stat-icon">👥</div></div>
        <div class="stat-card"><div class="stat-info"><p>Approved Farmers</p><h2>{{ $totalFarmers }}</h2></div><div class="stat-icon">👨‍🌾</div></div>
    </div>

    <div class="two-col">
        <div class="dashboard-card">
            <div class="card-header"><h3>Revenue by month</h3></div>
            @php $maxRev = max(1, (float) $revenueByMonth->max()); @endphp
            @forelse($revenueByMonth as $month => $amount)
                <div class="bar-row"><span class="label">{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('M Y') }}</span><span class="bar"><i style="width: {{ round($amount / $maxRev * 100) }}%"></i></span><span class="value">Rs. {{ number_format($amount, 0) }}</span></div>
            @empty
                <p class="muted">No confirmed or completed orders yet.</p>
            @endforelse
        </div>

        <div class="dashboard-card">
            <div class="card-header"><h3>Orders by status</h3></div>
            @php $maxStatus = max(1, (int) $ordersByStatus->max()); @endphp
            @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $st)
                <div class="bar-row"><span class="label">{{ ucfirst($st) }}</span><span class="bar"><i style="width: {{ round(($ordersByStatus[$st] ?? 0) / $maxStatus * 100) }}%"></i></span><span class="value">{{ $ordersByStatus[$st] ?? 0 }}</span></div>
            @endforeach
        </div>
    </div>

    <div class="two-col">
        <div class="dashboard-card">
            <div class="card-header"><h3>Top products</h3></div>
            <div class="table-wrap"><table class="orders-table">
                <thead><tr><th>Product</th><th>Orders</th><th>Revenue</th></tr></thead>
                <tbody>
                @forelse($topProducts as $product)
                    <tr><td>{{ $product->name }}</td><td>{{ $product->orders_count }}</td><td>Rs. {{ number_format($product->revenue ?? 0, 2) }}</td></tr>
                @empty
                    <tr><td colspan="3" class="empty">No products yet.</td></tr>
                @endforelse
                </tbody>
            </table></div>
        </div>

        <div class="dashboard-card">
            <div class="card-header"><h3>Top farmers</h3></div>
            <div class="table-wrap"><table class="orders-table">
                <thead><tr><th>Farmer</th><th>Orders</th><th>Revenue</th></tr></thead>
                <tbody>
                @forelse($topFarmers as $farmer)
                    <tr><td>{{ $farmer->name }}<div class="muted">{{ $farmer->farmerProfile->stall_name ?? '' }}</div></td><td>{{ $farmer->orders_total }}</td><td>Rs. {{ number_format($farmer->revenue_total, 2) }}</td></tr>
                @empty
                    <tr><td colspan="3" class="empty">No farmers yet.</td></tr>
                @endforelse
                </tbody>
            </table></div>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-header"><h3>Products per category</h3></div>
        @php $maxCat = max(1, (int) $categories->max('products_count')); @endphp
        @forelse($categories as $category)
            <div class="bar-row"><span class="label">{{ $category->name }}</span><span class="bar"><i style="width: {{ round($category->products_count / $maxCat * 100) }}%"></i></span><span class="value">{{ $category->products_count }}</span></div>
        @empty
            <p class="muted">No categories yet.</p>
        @endforelse
    </div>
</div>
@endsection
