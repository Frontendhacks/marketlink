@extends('admin.master')

@section('title', 'Admin Dashboard')

@section('main')

<div class="dashboard-content">

    {{-- =========================
         WELCOME
    ========================== --}}
    <div class="welcome-section">
        <h1>Welcome Back, Admin</h1>
        <p>Here's what's happening with MarketLink today.</p>
    </div>


    {{-- =========================
         STATISTICS
    ========================== --}}
    <div class="stats-grid">

        {{-- Total Farmers --}}
        <div class="stat-card">
            <div class="stat-info">
                <p>Total Farmers</p>
                <h2>{{ $totalFarmers }}</h2>
            </div>

            <div class="stat-icon">👨‍🌾</div>
        </div>


        {{-- Total Customers --}}
        <div class="stat-card">
            <div class="stat-info">
                <p>Total Customers</p>
                <h2>{{ $totalCustomers }}</h2>
            </div>

            <div class="stat-icon">👥</div>
        </div>


        {{-- Total Markets --}}
        <div class="stat-card">
            <div class="stat-info">
                <p>Total Markets</p>
                <h2>{{ $totalMarkets }}</h2>
            </div>

            <div class="stat-icon">📍</div>
        </div>


        {{-- Total Products --}}
        <div class="stat-card">
            <div class="stat-info">
                <p>Total Products</p>
                <h2>{{ $totalProducts }}</h2>
            </div>

            <div class="stat-icon">📦</div>
        </div>


        {{-- Total Orders --}}
        <div class="stat-card">
            <div class="stat-info">
                <p>Total Orders</p>
                <h2>{{ $totalOrders }}</h2>
            </div>

            <div class="stat-icon">🛒</div>
        </div>


        {{-- Pending Approvals --}}
        <div class="stat-card">
            <div class="stat-info">
                <p>Pending Approvals</p>
                <h2>{{ $pendingFarmers }}</h2>
            </div>

            <div class="stat-icon">⏳</div>
        </div>

    </div>


    {{-- =========================
         RECENT ORDERS
    ========================== --}}
    <div class="dashboard-card">

        <div class="card-header">
            <h3>Recent Orders</h3>

            <a href="{{ route('admin.orders') }}">
                View All
            </a>
        </div>


        <div style="overflow-x:auto;">

            <table class="orders-table">

                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Farmer</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($recentOrders as $order)

                        <tr>

                            <td>
                                #{{ $order->order_id }}
                            </td>


                            <td>
                                {{ $order->customer?->name ?? 'N/A' }}
                            </td>


                            <td>
                                {{ $order->product?->name ?? 'N/A' }}
                            </td>


                            <td>
                                {{ $order->product?->farmer?->name ?? 'N/A' }}
                            </td>


                            <td>
                                {{ $order->quantity }}
                            </td>


                            <td>
                                Rs. {{ number_format($order->total_amount, 2) }}
                            </td>


                            <td>

                                <span class="status {{ strtolower($order->order_status) }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" style="text-align:center; padding:25px;">
                                No orders found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================
         FARMER APPROVALS
    ========================== --}}
    <div class="dashboard-card">

        <div class="card-header">

            <h3>Farmer Approvals</h3>

            <a href="{{ route('admin.farmers') }}">
                View All
            </a>

        </div>


        @forelse($pendingRequests as $request)

            @php
                $farmerName = $request->farmer?->name ?? 'Unknown Farmer';

                $initials = collect(
                    preg_split('/\s+/', trim($farmerName))
                )
                ->filter()
                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                ->take(2)
                ->implode('');
            @endphp


            <div class="Approval">

                <div class="Farmer-avatar">
                    {{ $initials ?: 'F' }}
                </div>


                <div class="Farmer-details">

                    <strong>
                        {{ $farmerName }}
                    </strong>

                    <span>
                        {{ $request->stall_name ?? 'Farmer Profile' }}
                    </span>

                </div>


                {{-- Approve Farmer --}}
                <form
                    action="{{ route('admin.farmers.approve', $request->farmer_id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to approve {{ $farmerName }}?');"
                >

                    @csrf

                    <button
                        type="submit"
                        class="approval-btn"
                    >
                        Approve
                    </button>

                </form>

            </div>

        @empty

            <div style="padding:25px; text-align:center; color:#777;">
                No pending farmer approvals.
            </div>

        @endforelse

    </div>

</div>

@endsection