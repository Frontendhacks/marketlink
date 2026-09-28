<!DOCTYPE html>

<html lang="en">
<head>
<title>My Profile - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/style.css') }}" rel="stylesheet"/>
<style>
body{background:#f7f5ef}
.profile-card{background:white;border-radius:15px;padding:30px;box-shadow:0 4px 15px rgba(0,0,0,.06)}
.profile-avatar{width:100px;height:100px;border-radius:50%;background:#2f6b3f;color:white;display:flex;align-items:center;justify-content:center;font-size:42px;margin:auto}
.info-box{background:#f7f5ef;border-radius:10px;padding:15px}
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

    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
        <li>
            <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Customer Dashboard
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
            <hr class="dropdown-divider">
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
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
<div class="row g-4">
<div class="col-lg-3">
<div class="sidebar">
<div class="sidebar-title">Customer Panel</div>
<a class="sidebar-link" href="{{ route('customer.dashboard') }}">
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
<div class="sidebar-title mt-3">Account</div>
<a class="sidebar-link active" href="{{ route('profile') }}">
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
<div class="profile-card">
<div class="text-center mb-4">
<div class="profile-avatar">
<i class="bi bi-person"></i>
</div>
<h2 class="fw-bold mt-3 mb-1" id="profileName">
    {{ auth()->user()->name }}
</h2>
<p class="text-muted mb-0" id="profileEmail">
    {{ auth()->user()->email }}
</p>
</div>
<hr/>
<h5 class="fw-bold mb-4">
<i class="bi bi-person me-2"></i>
Personal Information
</h5>
<div class="row g-4">
<div class="col-md-6">
<div class="info-box">
<small class="text-muted d-block mb-1">Full Name</small>
<strong id="name">{{ auth()->user()->name }}</strong>
</div>
</div>
<div class="col-md-6">
<div class="info-box">
<small class="text-muted d-block mb-1">Email</small>
<strong id="email">{{ auth()->user()->email }}</strong>
</div>
</div>
<div class="col-md-6">
<div class="info-box">
<small class="text-muted d-block mb-1">Phone</small>
<strong id="phone">{{ auth()->user()->contact ?? 'Not added' }}</strong>
</div>
</div>
<div class="col-md-6">
<div class="info-box">
<small class="text-muted d-block mb-1">City</small>
<strong id="city">{{ auth()->user()->address ?? 'Not added' }}</strong>
</div>
</div>
</div>
<hr class="my-4"/>
<h5 class="fw-bold mb-4">
<i class="bi bi-person-badge me-2"></i>
Account Information
</h5>
<div class="row g-4">
<div class="col-md-6">
<div class="info-box">
<small class="text-muted d-block mb-1">Account Type</small>
<strong>Customer</strong>
</div>
</div>
<div class="col-md-6">
<div class="info-box">
<small class="text-muted d-block mb-1">Account Status</small>
<strong class="text-primary">Active</strong>
</div>
</div>
</div>
<div class="text-end mt-4">
<a class="btn btn-primary" href="{{ route('account.settings') }}">
<i class="bi bi-pencil me-1"></i>
Edit Profile
</a>
</div>
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