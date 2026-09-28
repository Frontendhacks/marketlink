<!DOCTYPE html>

<html lang="en">
<head>
<title>Customer Dashboard - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/style.css') }}" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/common.css') }}" rel="stylesheet"/>
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
@auth
<div class="dropdown">

    <button
        class="btn profile-btn dropdown-toggle"
        data-bs-toggle="dropdown"
        type="button"
        aria-expanded="false"
    >
        <i class="bi bi-person-circle me-1"></i>
        {{ auth()->user()->name }}
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

        <li>
            <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('myorders') }}">
                <i class="bi bi-bag me-2"></i>
                My Orders
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('profile') }}">
                <i class="bi bi-person me-2"></i>
                My Profile
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('account.settings') }}">
                <i class="bi bi-gear me-2"></i>
                Account Settings
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf

                <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>
        </li>

    </ul>

</div>
@endauth
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
<a class="sidebar-link " href="{{ route('customer.dashboard') }}">
<i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
<a class="sidebar-link active" href="{{ route('myorders') }}">
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
<form action="{{ route('logout') }}" method="POST" class="m-0">
    @csrf
    <button type="submit" class="sidebar-link text-danger border-0 bg-transparent w-100 text-start">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </button>
</form>
</div>
</div>
<div style="
        flex:1;
        background:transparent;
    ">
<div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:18px;
        ">
<div>
<h2 style="
                    margin:0;
                    color:#1d2939;
                    font-size:25px;
                    font-weight:600;
                ">
                    My Orders
                </h2>
<p style="
                    margin:5px 0 0;
                    color:#98a2b3;
                    font-size:13px;
                ">
                    View and track your recent orders
                </p>
</div>
<button class="order-action" data-action="filter" style="
                border:1px solid #d0d5dd;
                background:white;
                color:#475467;
                padding:9px 14px;
                border-radius:7px;
                font-size:13px;
            ">
<i class="bi bi-funnel"></i>
                Filter
            </button>
</div>
@if($orders->count())

    @foreach($orders as $order)

        <div style="
            background:white;
            border-radius:12px;
            padding:18px;
            margin-bottom:12px;
            border:1px solid #eaecf0;
        ">

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                border-bottom:1px solid #f0f2f4;
                padding-bottom:12px;
                margin-bottom:12px;
            ">

                <div>
                    <span style="
                        font-size:14px;
                        font-weight:600;
                        color:#344054;
                    ">
                        Order #{{ $order->order_id }}
                    </span>

                    <span style="
                        color:#98a2b3;
                        font-size:12px;
                        margin-left:12px;
                    ">
                        {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                    </span>
                </div>

                <span style="
                    background:#dbeafe;
                    color:#2f6b3f;
                    padding:5px 10px;
                    border-radius:15px;
                    font-size:11px;
                ">
                    {{ ucfirst($order->order_status) }}
                </span>

            </div>

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                gap:20px;
            ">

                <div>
                    <p style="margin:0 0 5px;font-size:14px;">
                        <b>
                            {{ $order->product->name ?? 'Product' }}
                        </b>
                    </p>

                    <p style="margin:0;color:#98a2b3;font-size:12px;">
                        Quantity: {{ $order->quantity }}
                    </p>
                </div>

                <div style="
                    font-size:14px;
                    font-weight:600;
                    color:#344054;
                ">
                    Rs. {{ number_format($order->total_amount, 2) }}
                </div>

                <a
    href="{{ route('myorders.details', $order->order_id) }}"
    style="
        border:1px solid #2f6b3f;
        background:white;
        color:#2f6b3f;
        padding:7px 14px;
        border-radius:6px;
        font-size:12px;
        text-decoration:none;
        display:inline-block;
    "
>
    View Details
</a>

            </div>

        </div>

    @endforeach

@else

    <div style="
        background:white;
        border-radius:12px;
        padding:40px 20px;
        border:1px solid #eaecf0;
        text-align:center;
    ">
        <i class="bi bi-bag-x" style="font-size:40px;color:#98a2b3;"></i>

        <h5 style="margin-top:15px;color:#344054;">
            No Orders Yet
        </h5>

        <p style="color:#98a2b3;font-size:14px;">
            You haven't placed any orders yet.
        </p>

        <a href="{{ route('products') }}" class="btn btn-success">
            Browse Products
        </a>
    </div>

@endif
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