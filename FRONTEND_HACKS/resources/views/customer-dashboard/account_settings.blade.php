<!DOCTYPE html>

<html lang="en">
<head>
<title>Account Settings - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="{{ asset('customers/assets/css/style.css') }}" rel="stylesheet"/>
<style>
body{background:#f7f5ef}
.page-card{background:white;border-radius:15px;padding:25px;box-shadow:0 4px 15px rgba(0,0,0,.06)}
.settings-section{border-bottom:1px solid #e5e7eb;padding-bottom:25px;margin-bottom:25px}
.settings-section:last-child{border-bottom:0;margin-bottom:0}
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
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
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

        <li><hr class="dropdown-divider"></li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
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
<a class="sidebar-link" href="{{ route('pre.order') }}">
<i class="bi bi-box-seam"></i>Pre-orders
</a>
<div class="sidebar-title mt-3">Account</div>
<a class="sidebar-link" href="{{ route('profile') }}">
<i class="bi bi-person"></i>My Profile
</a>

    <a class="sidebar-link active" href="{{ route('account.settings') }}">
<i class="bi bi-gear"></i>Account Settings
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
<div class="page-card">
<h2 class="fw-bold mb-1">Account Settings</h2>
<p class="text-muted mb-4">Manage your account information and password.</p>
<div class="settings-section">
    <h5 class="fw-bold mb-3">
        <i class="bi bi-person me-2"></i>Personal Information
    </h5>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input
                    class="form-control"
                    name="name"
                    type="text"
                    value="{{ old('name', auth()->user()->name) }}"
                    required
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input
                    class="form-control"
                    name="email"
                    type="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    required
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input
                    class="form-control"
                    name="contact"
                    type="text"
                    value="{{ old('contact', auth()->user()->contact) }}"
                    placeholder="Enter phone number"
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input
                    class="form-control"
                    name="address"
                    type="text"
                    value="{{ old('address', auth()->user()->address) }}"
                    placeholder="Enter address"
                >
            </div>

        </div>

        <button class="btn btn-primary mt-4" type="submit">
            <i class="bi bi-check-lg me-1"></i>Save Changes
        </button>
    </form>
</div>
<div class="settings-section">
    <h5 class="fw-bold mb-3">
        <i class="bi bi-lock me-2"></i>Change Password
    </h5>

    <form action="{{ route('account.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-12">
                <label class="form-label">Current Password</label>
                <input
                    class="form-control"
                    name="current_password"
                    type="password"
                    required
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">New Password</label>
                <input
                    class="form-control"
                    name="password"
                    type="password"
                    required
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">Confirm New Password</label>
                <input
                    class="form-control"
                    name="password_confirmation"
                    type="password"
                    required
                >
            </div>

        </div>

        <button class="btn btn-primary mt-4" type="submit">
            Update Password
        </button>
    </form>
</div>
<div class="settings-section">
<h5 class="fw-bold mb-3">
<i class="bi bi-bell me-2"></i>Notifications
</h5>
<div class="form-check form-switch mb-3">
<input checked="" class="form-check-input" id="orderNotifications" type="checkbox"/>
<label class="form-check-label" for="orderNotifications">
Order updates
</label>
</div>
<div class="form-check form-switch">
<input checked="" class="form-check-input" id="productNotifications" type="checkbox"/>
<label class="form-check-label" for="productNotifications">
New product notifications
</label>
</div>
</div>
<div>
<h5 class="fw-bold mb-3 text-danger">
<i class="bi bi-exclamation-triangle me-2"></i>Account
</h5>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        Logout
    </button>
</form>
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