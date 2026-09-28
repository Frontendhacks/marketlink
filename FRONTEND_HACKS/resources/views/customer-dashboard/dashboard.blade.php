<!DOCTYPE html>

<html lang="en">
<head>
<title>Customer Dashboard - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('customers/assets/css/common.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
<div class="container">
<a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
<img alt="MarketLink" class="me-2" height="45" src="{{ asset('customers/Images/logo.png') }}" width="45"/>
<span>Market<span class="text-success">Link</span></span>
</a>
<button class="navbar-toggler" data-bs-target="#mainNavbar" data-bs-toggle="collapse" type="button">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="mainNavbar">
<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('markets') }}">Markets</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('farmers') }}">Farmers</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
<li class="nav-item"><a class="nav-link active fw-semibold text-success" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
</ul>
<div class="d-flex align-items-center gap-3"><a class="nav-icon position-relative" href="{{ route('products') }}">
<i class="bi bi-cart3 fs-5"></i><span class="cart-badge">0</span></a>
<div class="dropdown"><button class="btn profile-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">
    <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
</button>
<ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
<li><a class="dropdown-item" href="{{ route('customer.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li><li>
<a class="dropdown-item" href="{{ route('myorders') }}">
<i class="bi bi-bag me-2"></i>My Orders
                            </a>
</li>
<li>
<a class="dropdown-item" href="{{ route('profile') }}">
<i class="bi bi-person me-2"></i>My Profile
</a>
</li>
<li>
    <a class="dropdown-item" href="{{ route('account.settings') }}">
        <i class="bi bi-gear me-2"></i>Account Settings
    </a>
</li>
<li><hr class="dropdown-divider"/></li>
<li>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="dropdown-item text-danger">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </button>
    </form>
</li>
</ul>
</div>
</div>
</div>
</div>
</nav>
<div class="container-fluid py-4">
<div class="container">
<div class="row g-4 dashboard-wrapper">
<div class="col-lg-3">
<div class="sidebar">
<div class="sidebar-title">
                        Customer Panel
                    </div>
<a class="sidebar-link active" href="{{ route('customer.dashboard') }}">
<i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
<a class="sidebar-link" href="{{ route('myorders') }}">
<i class="bi bi-bag-check"></i>
                  My Orders
                    </a>
<a class="sidebar-link" href="{{ route('favorites') }}">
<i class="bi bi-heart"></i>
                        Favorites
                    </a>
<a class="sidebar-link" href="{{ route('pre.order') }}">
<i class="bi bi-box-seam"></i>
                        Pre-orders
                    </a>
<div class="sidebar-title mt-3">
                        Account
                    </div>
<a class="sidebar-link" href="{{ route('profile') }}">
<i class="bi bi-person"></i>
    My Profile
</a>
<a class="sidebar-link" href="{{ route('account.settings') }}">
<i class="bi bi-gear"></i>
                        Account Settings
                    </a>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-link text-danger border-0 bg-transparent w-100 text-start">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </button>
</form>
</div>
</div>
<div class="col-lg-9">
<div class="welcome-card mb-4">
<i class="bi bi-shop welcome-icon"></i>
<h2>
                        Welcome back, <span id="customerName">{{ $customer->name }}</span>!
                    </h2>
<p class="mb-0">
                        Explore fresh products, connect with farmers
                        and discover local markets.
                    </p>
</div>
<!-- Stats -->
<div class="row g-3 mb-4">
<div class="col-sm-6 col-xl-3">
<div class="stat-card p-3 h-100">
<div class="stat-icon mb-3">
<i class="bi bi-bag-check"></i>
</div>
<small class="text-muted">
                                Active Orders
                            </small>
<h3 class="fw-bold mb-0" id="activeOrders">
    {{ $activeOrders }}
</h3>
</div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="stat-card p-3 h-100">
<div class="stat-icon mb-3">
<i class="bi bi-check-circle"></i>
</div>
<small class="text-muted">
                                Completed
                            </small>
<h3 class="fw-bold mb-0" id="completedOrders">
    {{ $completedOrders }}
</h3>
</div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="stat-card p-3 h-100">
<div class="stat-icon mb-3">
<i class="bi bi-heart"></i>
</div>
<small class="text-muted">
                                Favorites
                            </small>
<h3 class="fw-bold mb-0" id="favoriteCount">
    {{ $favoriteCount }}
</h3>
</div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="stat-card p-3 h-100">
<div class="stat-icon mb-3">
<i class="bi bi-box-seam"></i>
</div>
<small class="text-muted">
                                Pre-orders
                            </small>
<h3 class="fw-bold mb-0" id="preorderCount">
    {{ $preorderCount }}
</h3>
</div>
</div>
</div>
<div class="row g-4">
<div class="col-xl-8">
<div class="dashboard-card p-4">
<div class="d-flex justify-content-between align-items-center mb-3">
<h5 class="dashboard-card-title mb-0">
    Recent Orders
</h5>
<a class="text-success text-decoration-none small" href="{{ route('myorders') }}">
    View All Orders
</a>
</div>
<div class="table-responsive">
<table class="table align-middle mb-0">
<thead>
<tr>
<th>Order</th>
<th>Product</th>
<th>Qty</th>
<th>Date</th>
<th>Status</th>
</tr>
</thead>
<tbody id="ordersTable">

@if($recentOrders->count())

    @foreach($recentOrders as $order)

        <tr>

            <td>
                <strong>
                    #{{ $order->order_id }}
                </strong>
            </td>

            <td>
                {{ $order->product->name ?? 'Product' }}
            </td>

            <td>
                {{ $order->quantity }}
            </td>

            <td>
                {{ $order->order_date->format('d M Y') }}
            </td>

            <td>

                @if($order->order_status === 'pending')

                    <span class="badge bg-warning-subtle text-warning-emphasis">
                        Pending
                    </span>

                @elseif($order->order_status === 'confirmed')

                    <span class="badge bg-primary-subtle text-primary">
                        Confirmed
                    </span>

                @elseif($order->order_status === 'completed')

                    <span class="badge bg-success-subtle text-success">
                        Completed
                    </span>

                @elseif($order->order_status === 'cancelled')

                    <span class="badge bg-danger-subtle text-danger">
                        Cancelled
                    </span>

                @else

                    <span class="badge bg-secondary-subtle text-secondary">
                        {{ ucfirst($order->order_status) }}
                    </span>

                @endif

            </td>

        </tr>

    @endforeach

@else

    <tr>

        <td
            colspan="5"
            class="text-center text-muted py-4"
        >
            <i class="bi bi-bag-x fs-3 d-block mb-2"></i>

            No orders yet.

        </td>

    </tr>

@endif

</tbody>
</table>
</div>
</div>
</div>
<div class="col-xl-4">
<div class="dashboard-card p-4">
<h5 class="dashboard-card-title mb-3">
    Quick Actions
</h5>
<a class="action-card" href="{{ route('products') }}">
    <span class="action-icon">
        <i class="bi bi-basket"></i>
    </span>
    Browse Products
</a>
<a class="action-card" href="{{ route('markets') }}">
<span class="action-icon">
<i class="bi bi-shop"></i>
</span>

                                Find Markets
                            </a>
<a class="action-card" href="{{ route('farmers') }}">
<span class="action-icon">
<i class="bi bi-person-workspace"></i>
</span>
                                View Farmers
                            </a>
</div>
</div>
</div>
<!-- Profile -->
<div class="dashboard-card p-4 mt-4">
<div class="d-flex justify-content-between align-items-center mb-3">
<h5 class="dashboard-card-title mb-0">
                            Account Information
                        </h5>
<a class="btn btn-sm btn-outline-success" href="{{ route('profile') }}">
<i class="bi bi-pencil me-1"></i>
                            Edit Profile
                        </a>
</div>
<div class="row">
<div class="col-md-6">
<div class="profile-info">
<small class="text-muted">Name</small>
<div class="fw-semibold" id="profileName">
    {{ $customer->name }}
</div>
</div>
</div>
<div class="col-md-6">
<div class="profile-info">
<small class="text-muted">Email</small>
<div class="fw-semibold" id="customerEmail">
    {{ $customer->email }}
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<footer class="footer mt-5 pt-5">
<div class="container">
<div class="row g-4 pb-4">
<div class="col-lg-4">
<h5>MarketLink</h5>
<p class="small">Connecting customers with farmers, fresh products and local markets.</p>
</div>
<div class="col-6 col-lg-2">
<h5 class="fs-6">Quick Links</h5>
<ul class="list-unstyled small">
<li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
<li class="mb-2">
<a href="{{ route('products') }}">Products</a>
</li>
<li class="mb-2">
<a href="{{ route('farmers') }}">Farmers</a>
</li>
<li>
<a href="{{ route('markets') }}">Markets</a>
</li>
</ul>
</div>
<div class="col-6 col-lg-3">
<h5 class="fs-6">Customer</h5>
<ul class="list-unstyled small">
<li class="mb-2">
<a href="{{ route('customer.dashboard') }}">Dashboard</a>
</li>
<li class="mb-2">
<a href="{{ route('myorders') }}">My Orders</a>
</li>
<li class="mb-2">
<a href="{{ route('favorites') }}">Favorites</a>
</li>
<li>
<a href="{{ route('pre.order') }}">Pre-orders</a>
</li>
</ul>
</div>
<div class="col-lg-3">
<h5 class="fs-6">Contact</h5>
<p class="small mb-2">
<i class="bi bi-envelope me-2"></i>
                    support@marketlink.com
                </p>
<p class="small mb-2">
<i class="bi bi-telephone me-2"></i>
                    +92 300 0000000
                </p>
<p class="small">
<i class="bi bi-geo-alt me-2"></i>
                    Karachi, Pakistan
                </p>
</div>
</div>
<div class="footer-bottom text-center py-3">
<small>
                © 2026 MarketLink. All Rights Reserved.
            </small>
</div>
</div>
</footer>
<script src="{{ asset('customers/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>