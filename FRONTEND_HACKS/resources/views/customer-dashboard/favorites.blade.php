<!DOCTYPE html>

<html lang="en">
<head>
<title>Favorites - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/style.css') }}" rel="stylesheet"/>
<style>
body{background:#f7f5ef}
.page-card{background:white;border-radius:15px;padding:25px;box-shadow:0 4px 15px rgba(0,0,0,.06)}
.product-card{background:white;border:0;border-radius:15px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,.06);height:100%}
.product-card img{height:190px;width:100%;object-fit:cover}
.favorite-icon{color:#dc3545;font-size:22px}
</style>
<link href="{{ asset('customers/assets/css/common.css') }}" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
<div class="container">
<a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
<img
    alt="MarketLink"
    class="me-2"
    height="45"
    src="{{ asset('customers/Images/logo.png') }}"
    width="45"
/>
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
<a class="sidebar-link active" href="{{ route('favorites') }}">
<i class="bi bi-heart"></i>Favorites
</a>
<a class="sidebar-link" href="{{ route('pre.order') }}">
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
<h2 class="fw-bold mb-1">My Favorites</h2>
<p class="text-muted mb-0">Products you have saved for later.</p>
</div>
<div class="row g-4" id="favoriteProducts">

@if($favorites->count())

    @foreach($favorites as $favorite)

        @if($favorite->product)

            <div class="col-md-6 col-xl-4">

                <div class="product-card">

                    <img
                        alt="{{ $favorite->product->name }}"
                        src="{{ $favorite->product->image_url }}"
                    />

                    <div class="p-3">

                        <div class="d-flex justify-content-between">

                            <h5>
                                {{ $favorite->product->name }}
                            </h5>

                            <i class="bi bi-heart-fill favorite-icon"></i>

                        </div>

                        <p class="text-muted mb-2">
                            {{ $favorite->product->description ?? 'Fresh farm product' }}
                        </p>

                        <a
                            class="btn btn-primary w-100"
                            href="{{ route('product.details', $favorite->product->product_id) }}"
                        >
                            View Product
                        </a>

                    </div>

                </div>

            </div>

        @endif

    @endforeach

@else

    <div class="col-12">

        <div class="product-card text-center p-5">

            <i
                class="bi bi-heart"
                style="font-size:50px;color:#dc3545;"
            ></i>

            <h4 class="mt-3">
                No Favorites Yet
            </h4>

            <p class="text-muted">
                You haven't saved any products to your favorites yet.
            </p>

            <a
                href="{{ route('products') }}"
                class="btn btn-primary"
            >
                Browse Products
            </a>

        </div>

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