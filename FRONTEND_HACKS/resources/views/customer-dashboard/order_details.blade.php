<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Details - MarketLink</title>

    <meta charset="utf-8"/>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    />

    <link
        href="{{ asset('customers/assets/css/style.css') }}"
        rel="stylesheet"
    />

    <link
        href="{{ asset('customers/assets/css/common.css') }}"
        rel="stylesheet"
    />
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">

    <div class="container">

        <a
            class="navbar-brand d-flex align-items-center fw-bold"
            href="{{ route('home') }}"
        >
            <img
                alt="MarketLink"
                class="me-2"
                height="45"
                src="{{ asset('customers/Images/logo.png') }}"
                width="45"
            />

            <span>
                Market<span class="text-success">Link</span>
            </span>
        </a>

        <button
            class="navbar-toggler"
            data-bs-target="#mainNavbar"
            data-bs-toggle="collapse"
            type="button"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('home') }}"
                    >
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('markets') }}"
                    >
                        Markets
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('farmers') }}"
                    >
                        Farmers
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('products') }}"
                    >
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link active fw-semibold text-success"
                        href="{{ route('customer.dashboard') }}"
                    >
                        Dashboard
                    </a>
                </li>

            </ul>

            <div class="d-flex align-items-center gap-3">

                <a
                    class="nav-icon position-relative"
                    href="{{ route('products') }}"
                >
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="cart-badge">0</span>
                </a>

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
                            <a
                                class="dropdown-item"
                                href="{{ route('customer.dashboard') }}"
                            >
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item"
                                href="{{ route('myorders') }}"
                            >
                                <i class="bi bi-bag me-2"></i>
                                My Orders
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item"
                                href="{{ route('profile') }}"
                            >
                                <i class="bi bi-person me-2"></i>
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item"
                                href="{{ route('account.settings') }}"
                            >
                                <i class="bi bi-gear me-2"></i>
                                Account Settings
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                                class="m-0"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="dropdown-item text-danger"
                                >
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

                    <a
                        class="sidebar-link"
                        href="{{ route('customer.dashboard') }}"
                    >
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>

                    <a
                        class="sidebar-link active"
                        href="{{ route('myorders') }}"
                    >
                        <i class="bi bi-bag-check"></i>
                        My Orders
                    </a>

                    <a
                        class="sidebar-link"
                        href="{{ route('favorites') }}"
                    >
                        <i class="bi bi-heart"></i>
                        Favorites
                    </a>

                    <a
                        class="sidebar-link"
                        href="{{ route('pre.order') }}"
                    >
                        <i class="bi bi-box-seam"></i>
                        Pre-orders
                    </a>

                    <div class="sidebar-title mt-3">
                        Account
                    </div>

                    <a
                        class="sidebar-link"
                        href="{{ route('profile') }}"
                    >
                        <i class="bi bi-person"></i>
                        My Profile
                    </a>

                    <a
                        class="sidebar-link"
                        href="{{ route('account.settings') }}"
                    >
                        <i class="bi bi-gear"></i>
                        Account Settings
                    </a>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="m-0"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="sidebar-link text-danger border-0 bg-transparent w-100 text-start"
                        >
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>

                    </form>

                </div>

            </div>


            <div class="col-lg-9">

                <div class="mb-4">

                    <a
                        href="{{ route('myorders') }}"
                        class="text-decoration-none text-success"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to My Orders
                    </a>

                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h2 class="mb-1">
                            Order #{{ $order->order_id }}
                        </h2>

                        <p class="text-muted mb-0">
                            Order details and information
                        </p>

                    </div>


                    @if($order->order_status === 'pending')

                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2">
                            Pending
                        </span>

                    @elseif($order->order_status === 'confirmed')

                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            Confirmed
                        </span>

                    @elseif($order->order_status === 'completed')

                        <span class="badge bg-success-subtle text-success px-3 py-2">
                            Completed
                        </span>

                    @elseif($order->order_status === 'cancelled')

                        <span class="badge bg-danger-subtle text-danger px-3 py-2">
                            Cancelled
                        </span>

                    @else

                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                            {{ ucfirst($order->order_status) }}
                        </span>

                    @endif

                </div>


                <div class="row g-4">


                    <div class="col-lg-8">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body p-4">

                                <h5 class="fw-semibold mb-4">
                                    <i class="bi bi-bag-check me-2 text-success"></i>
                                    Order Information
                                </h5>


                                <div class="row g-4">


                                    <div class="col-md-6">

                                        <div class="text-muted small mb-1">
                                            Order ID
                                        </div>

                                        <div class="fw-semibold">
                                            #{{ $order->order_id }}
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="text-muted small mb-1">
                                            Order Date
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $order->order_date->format('d M Y, h:i A') }}
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="text-muted small mb-1">
                                            Order Status
                                        </div>

                                        <div class="fw-semibold">
                                            {{ ucfirst($order->order_status) }}
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="text-muted small mb-1">
                                            Quantity
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $order->quantity }}
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card border-0 shadow-sm mt-4">

                            <div class="card-body p-4">

                                <h5 class="fw-semibold mb-4">
                                    <i class="bi bi-box-seam me-2 text-success"></i>
                                    Product Information
                                </h5>


                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded bg-light d-flex align-items-center justify-content-center"
                                        style="width:80px;height:80px;"
                                    >
                                        <i class="bi bi-basket2 fs-2 text-success"></i>
                                    </div>


                                    <div>

                                        <h6 class="mb-1 fw-semibold">
                                            {{ $order->product->name ?? 'Product' }}
                                        </h6>

                                        <p class="text-muted small mb-0">
                                            Quantity:
                                            {{ $order->quantity }}
                                        </p>

                                        <a
    href="{{ route('product.details', $order->product->product_id) }}"
    class="btn btn-sm btn-outline-success mt-2"
>
    View Product
</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body p-4">

                                <h5 class="fw-semibold mb-4">
                                    <i class="bi bi-receipt me-2 text-success"></i>
                                    Order Summary
                                </h5>


                                <div class="d-flex justify-content-between mb-3">

                                    <span class="text-muted">
                                        Product
                                    </span>

                                    <span class="fw-semibold text-end">
                                        {{ $order->product->name ?? 'Product' }}
                                    </span>

                                </div>


                                <div class="d-flex justify-content-between mb-3">

                                    <span class="text-muted">
                                        Quantity
                                    </span>

                                    <span class="fw-semibold">
                                        {{ $order->quantity }}
                                    </span>

                                </div>


                                <hr>


                                <div class="d-flex justify-content-between">

                                    <span class="fw-semibold">
                                        Total
                                    </span>

                                    <span class="fw-bold text-success">
                                        Rs. {{ number_format($order->total_amount, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        <div class="card border-0 shadow-sm mt-4">

                            <div class="card-body p-4">

                                <h6 class="fw-semibold mb-3">
                                    Need Help?
                                </h6>

                                <p class="text-muted small mb-0">
                                    If you have any questions about this
                                    order, please contact MarketLink support.
                                </p>

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

                <h5>
                    MarketLink
                </h5>

                <p class="small">
                    Connecting customers with farmers,
                    fresh products and local markets.
                </p>

            </div>


            <div class="col-6 col-lg-2">

                <h5 class="fs-6">
                    Quick Links
                </h5>

                <ul class="list-unstyled small">

                    <li class="mb-2">
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('products') }}">
                            Products
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('farmers') }}">
                            Farmers
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('markets') }}">
                            Markets
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-6 col-lg-3">

                <h5 class="fs-6">
                    Customer
                </h5>

                <ul class="list-unstyled small">

                    <li class="mb-2">
                        <a href="{{ route('customer.dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('myorders') }}">
                            My Orders
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('favorites') }}">
                            Favorites
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pre.order') }}">
                            Pre-orders
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-3">

                <h5 class="fs-6">
                    Contact
                </h5>

                <p class="small mb-2">
    <i class="bi bi-envelope me-2"></i>
    <a href="mailto:support@marketlink.com">
        support@marketlink.com
    </a>
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