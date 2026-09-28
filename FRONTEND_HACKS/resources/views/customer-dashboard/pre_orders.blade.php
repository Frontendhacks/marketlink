<!DOCTYPE html>

<html lang="en">
<head>
<title>Pre-orders - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/style.css') }}" rel="stylesheet"/>
<style>
body{background:#f7f5ef}
.page-card{background:white;border-radius:15px;padding:25px;box-shadow:0 4px 15px rgba(0,0,0,.06)}
.order-card{border:1px solid #e5e7eb;border-radius:12px;padding:20px;margin-bottom:15px;background:white}
.status{padding:6px 12px;border-radius:20px;font-size:13px}
</style>
<link href="{{ asset('customers/assets/css/common.css') }}" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
<div class="container">
<a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
<img alt="MarketLink" class="me-2" height="45" src="{{ asset('customers/Images/logo.png') }}" width="45"/>
<span>MarketLink</span>
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
<li class="nav-item"><a class="nav-link" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
</ul>
<div class="d-flex align-items-center gap-3">

<a class="nav-icon" href="{{ route('products') }}">
    <i class="bi bi-cart3 fs-5"></i>
</a>

@auth
<div class="dropdown">

    <button
        class="btn profile-btn dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        <i class="bi bi-person-circle me-1"></i>
        {{ auth()->user()->name }}
    </button>

    <ul class="dropdown-menu dropdown-menu-end">

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
<div class="row g-4">
<div class="col-lg-3">
<div class="sidebar">
<div class="sidebar-title">Customer Panel</div>
<a class="sidebar-link" href="{{ route('customer.dashboard') }}">
<i class="bi bi-speedometer2"></i>Dashboard
</a>
<a class="sidebar-link" href="{{ route('myorders') }}">
<i class="bi bi-bag-check"></i>My Orders
</a>
<a class="sidebar-link" href="{{ route('favorites') }}">
<i class="bi bi-heart"></i>Favorites
</a>
<a class="sidebar-link active" href="{{ route('pre.order') }}">
<i class="bi bi-box-seam"></i>Pre-orders
</a>
<div class="sidebar-title mt-3">Account</div>
<a class="sidebar-link" href="{{ route('profile') }}">
<i class="bi bi-person"></i>My Profile
</a>
<a class="sidebar-link" href="{{ route('account.settings') }}">
<i class="bi bi-gear"></i>Account Settings
</a>
<form action="{{ route('logout') }}" method="POST" class="m-0">
    @csrf

    <button type="submit" class="sidebar-link text-danger border-0 bg-transparent w-100 text-start">
        <i class="bi bi-box-arrow-right"></i>Logout
    </button>
</form>
</div>
</div>
<div class="col-lg-9">
<div class="page-card mb-4">
<div class="d-flex justify-content-between align-items-center">
<div>
<h2 class="fw-bold mb-1">My Pre-orders</h2>
<p class="text-muted mb-0">View and manage your product pre-orders.</p>
</div>
<a class="btn btn-primary" href="{{ route('pre.order.create') }}">
    <i class="bi bi-plus-lg me-1"></i>New Pre-order
</a>
</div>
</div>
<div id="preorderList">

@if($preorders->count())

    @foreach($preorders as $preorder)

        @if($preorder->product)

            <div class="order-card">

                <div class="row align-items-center">

                    <div class="col-md-3">
                        <h6 class="mb-1">
                            {{ $preorder->product->name }}
                        </h6>

                        <small class="text-muted">
                            Order #{{ $preorder->order_id }}
                        </small>
                    </div>

                    <div class="col-md-2">
                        <small class="text-muted d-block">
                            Quantity
                        </small>

                        <strong>
                            {{ $preorder->quantity }}
                        </strong>
                    </div>

                    <div class="col-md-2">
                        <small class="text-muted d-block">
                            Pickup
                        </small>

                        <strong>
                            @if($preorder->pickup_date)
                                {{ $preorder->pickup_date->format('l, d M Y') }}
                            @else
                                Not Set
                            @endif
                        </strong>
                    </div>

                    <div class="col-md-2">
                        <small class="text-muted d-block">
                            Total
                        </small>

                        <strong>
                            Rs. {{ number_format($preorder->total_amount, 2) }}
                        </strong>
                    </div>

                    <div class="col-md-3 text-md-end mt-3 mt-md-0">

                        @if($preorder->order_status === 'pending')

                            <span class="status bg-warning-subtle text-warning-emphasis">
                                Pending
                            </span>

                        @elseif($preorder->order_status === 'confirmed')

                            <span class="status bg-primary-subtle text-primary">
                                Confirmed
                            </span>

                        @elseif($preorder->order_status === 'completed')

                            <span class="status bg-success-subtle text-success">
                                Completed
                            </span>

                        @else

                            <span class="status bg-danger-subtle text-danger">
                                Cancelled
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @endif

    @endforeach

@else

    <div class="order-card text-center py-5">

        <i
            class="bi bi-box-seam"
            style="font-size:50px;color:#98a2b3;"
        ></i>

        <h5 class="mt-3">
            No Pre-orders Yet
        </h5>

        <p class="text-muted mb-3">
            You haven't placed any pre-orders yet.
        </p>

        <a
            href="{{ route('products') }}"
            class="btn btn-primary"
        >
            Browse Products
        </a>

    </div>

@endif

</div>
</div>
</div>
</div>
</div>
<footer class="footer mt-5 pt-5">
<div class="container">
<div class="footer-bottom text-center py-3">
<small>© 2026 MarketLink. All Rights Reserved.</small>
</div>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>