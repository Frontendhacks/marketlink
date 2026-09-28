<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'FarmHub Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .navbar-nav .nav-link.active {
            background-color: #084d2d !important;
            color: white !important;
        }

        .navbar-nav .nav-link:hover {
            background-color: #145c50;
            color: white !important;
        }

        @media (max-width: 768px) {
            nav {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
            }

            nav .container-fluid {
                padding: 15px !important;
            }

            nav .navbar-brand {
                margin-bottom: 10px !important;
            }

            nav .navbar-nav {
                display: flex !important;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 5px;
            }

            nav .navbar-nav .nav-link {
                padding: 8px 10px !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 20px !important;
            }

            .dashboard-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 15px;
            }

            .card {
                width: 100%;
            }

            footer {
                margin-left: 0 !important;
            }

            .main-footer {
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body style="background:#F8FFF9;">

@unless($__env->hasSection('bare'))
<nav class="navbar navbar-dark"
    style="width:250px;height:100vh;position:fixed;top:0;left:0;z-index:1000;background:#0B2F2A;display:block;">

    <div class="container-fluid" style="display:block;padding:20px;">

        <a class="navbar-brand fw-bold"
            href="{{ route('farmer.dashboard') }}"
            style="font-size:25px;margin-bottom:30px;display:block;">

           <img src="{{ asset('customers/Images/logo.png') }}"
    alt="FarmHub"
    height="50"
    width="50">

            <i class="bi bi-leaf-fill text-success"></i>
            FarmHub
        </a>

        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link rounded"
                    href="{{ route('farmer.dashboard') }}"
                    style="padding:12px 15px;">

                    <i class="bi bi-house-fill me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded"
    href="{{ route('farmer.products') }}"
    style="padding:12px 15px;">
                    Products
                </a>
            </li>

            <li class="nav-item">
               <a class="nav-link rounded"
    href="{{ route('farmer.stock') }}"
    style="padding:12px 15px;">

                    <i class="bi bi-box-seam me-2"></i>
                    Stock
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded"
    href="{{ route('farmer.orders') }}"
    style="padding:12px 15px;">

                    <i class="bi bi-cart3 me-2"></i>
                    Orders
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded" href="{{ route('farmer.customers') }}" style="padding:12px 15px;">
                    <i class="bi bi-people-fill me-2"></i> Customers
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded" href="{{ route('farmer.categories') }}" style="padding:12px 15px;">
                    <i class="bi bi-tags-fill me-2"></i> Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded" href="{{ route('farmer.markets') }}" style="padding:12px 15px;">
                    <i class="bi bi-shop me-2"></i> Markets
                </a>
            </li>

            <li class="nav-item">
               <a class="nav-link rounded"
    href="{{ route('farmer.reviews') }}"
    style="padding:12px 15px;">

                    <i class="bi bi-star-fill me-2"></i>
                    Reviews
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded" href="{{ route('farmer.profile') }}" style="padding:12px 15px;">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
            </li>

            <li class="nav-item">
                <form action="{{ route('farmer.logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="nav-link rounded text-danger border-0 bg-transparent w-100 text-start"
                        style="padding:12px 15px;">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
</nav>
@endunless

<div class="main-content" style="{{ $__env->hasSection('bare') ? '' : 'margin-left:250px;padding:30px;' }}">

    @yield('main')

</div>

@unless($__env->hasSection('bare'))
<footer class="main-footer"
    style="background:#0B2F2A;color:#fff;text-align:center;padding:15px;margin-top:30px;margin-left:250px;">

    © 2026 FarmHub | Fresh Products, Trusted Farms

</footer>
@endunless

<script>
    document.addEventListener("DOMContentLoaded", function () {

        let currentPage = window.location.pathname;

        document.querySelectorAll(".navbar-nav .nav-link").forEach(function (link) {

            let linkPage = link.getAttribute("href");

            if (linkPage && linkPage !== "#" && !link.closest("form") && new URL(linkPage, window.location.origin).pathname === currentPage) {
                link.classList.add("active");
            }

        });

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
@stack('scripts')

</body>
</html>