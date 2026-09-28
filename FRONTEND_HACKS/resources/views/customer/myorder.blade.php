<!DOCTYPE html>

<html lang="en">
<head>
<title>Customer Dashboard - MarketLink</title>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="./assets/css/style.css" rel="stylesheet"/>
<link href="assets/css/common.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
<div class="container">
<a class="navbar-brand d-flex align-items-center fw-bold" href="./index.html">
<img alt="MarketLink" class="me-2" height="45" src="Images/logo.png" width="45"/>
<span>Market<span class="text-success">Link</span></span>
</a>
<button class="navbar-toggler" data-bs-target="#mainNavbar" data-bs-toggle="collapse" type="button">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="mainNavbar">
<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link" href="./index.html">Home</a></li>
<li class="nav-item"><a class="nav-link" href="markets.html">Markets</a></li>
<li class="nav-item"><a class="nav-link" href="farmers.html">Farmers</a></li>
<li class="nav-item"><a class="nav-link" href="products.html">Products</a></li>
<li class="nav-item"><a class="nav-link active fw-semibold text-success" href="dashboard.html">Dashboard</a></li>
</ul>
<div class="d-flex align-items-center gap-3"><a class="nav-icon position-relative" href="products.html">
<i class="bi bi-cart3 fs-5"></i><span class="cart-badge">0</span></a>
<div class="dropdown"><button class="btn profile-btn dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="bi bi-person-circle me-1"></i>Customer</button>
<ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
<li><a class="dropdown-item" href="dashboard.html"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li><li>
<a class="dropdown-item" href="myorder.html">
<i class="bi bi-bag me-2"></i>My Orders
                            </a>
</li>
<li>
<a class="dropdown-item" href="profile.html">
<i class="bi bi-person me-2"></i>My Profile
                            </a>
</li>
<li><hr class="dropdown-divider"/></li>
<li>
<a class="dropdown-item text-danger" href="login.html">
<i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
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
<a class="sidebar-link active" href="dashboard.html">
<i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
<a class="sidebar-link" href="myorder.html">
<i class="bi bi-bag-check"></i>
                        My Orders
                    </a>
<a class="sidebar-link" href="favorites.html">
<i class="bi bi-heart"></i>
                        Favorites
                    </a>
<a class="sidebar-link" href="pre_orders.html">
<i class="bi bi-box-seam"></i>
                        Pre-orders
                    </a>
<div class="sidebar-title mt-3">
                        Account
                    </div>
<a class="sidebar-link" href="profile.html">
<i class="bi bi-person"></i>
                        My Profile
                    </a>
<a class="sidebar-link" href="account_settings.html">
<i class="bi bi-gear"></i>
                        Account Settings
                    </a>
<a class="sidebar-link text-danger" href="login.html">
<i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>
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
<!-- ORDER CARD 1 -->
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
                        Order #ML1025
                    </span>
<span style="
                        color:#98a2b3;
                        font-size:12px;
                        margin-left:12px;
                    ">
                        25 Sep 2026
                    </span>
</div>
<span style="
                    background:#dbeafe;
                    color:#2f6b3f;
                    padding:5px 10px;
                    border-radius:15px;
                    font-size:11px;
                ">
                    Delivered
                </span>
</div>
<div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
            ">
<div>
<p style="margin:0 0 5px;font-size:14px;">
<b>Fresh Vegetables</b>
</p>
<p style="margin:0;color:#98a2b3;font-size:12px;">
                        Tomatoes, Potatoes &amp; Spinach
                    </p>
</div>
<div style="font-size:14px;font-weight:600;color:#344054;">
                    Rs. 1,250
                </div>
<button class="order-action" data-action="details" style="
                    border:1px solid #2f6b3f;
                    background:white;
                    color:#2f6b3f;
                    padding:7px 14px;
                    border-radius:6px;
                    font-size:12px;
                ">
                    View Details
                </button>
</div>
</div>
<!-- ORDER CARD 2 -->
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
                        Order #ML1021
                    </span>
<span style="
                        color:#98a2b3;
                        font-size:12px;
                        margin-left:12px;
                    ">
                        21 Sep 2026
                    </span>
</div>
<span style="
                    background:#fff8e8;
                    color:#f97316;
                    padding:5px 10px;
                    border-radius:15px;
                    font-size:11px;
                ">
                    Pending
                </span>
</div>
<div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
            ">
<div>
<p style="margin:0 0 5px;font-size:14px;">
<b>Fresh Fruits</b>
</p>
<p style="margin:0;color:#98a2b3;font-size:12px;">
                        Apples, Oranges &amp; Bananas
                    </p>
</div>
<div style="font-size:14px;font-weight:600;color:#344054;">
                    Rs. 980
                </div>
<button class="order-action" data-action="track" style="
                    border:1px solid #2f6b3f;
                    background:white;
                    color:#2f6b3f;
                    padding:7px 14px;
                    border-radius:6px;
                    font-size:12px;
                ">
                    Track Order
                </button>
</div>
</div>
<!-- ORDER CARD 3 -->
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
                        Order #ML1017
                    </span>
<span style="
                        color:#98a2b3;
                        font-size:12px;
                        margin-left:12px;
                    ">
                        17 Sep 2026
                    </span>
</div>
<span style="
                    background:#feeceb;
                    color:#d92d20;
                    padding:5px 10px;
                    border-radius:15px;
                    font-size:11px;
                ">
                    Cancelled
                </span>
</div>
<div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
            ">
<div>
<p style="margin:0 0 5px;font-size:14px;">
<b>Dairy Products</b>
</p>
<p style="margin:0;color:#98a2b3;font-size:12px;">
                        Fresh Milk &amp; Yogurt
                    </p>
</div>
<div style="font-size:14px;font-weight:600;color:#344054;">
                    Rs. 650
                </div>
<button class="order-action" data-action="details" style="
                    border:1px solid #d0d5dd;
                    background:white;
                    color:#667085;
                    padding:7px 14px;
                    border-radius:6px;
                    font-size:12px;
                ">
                    View Details
                </button>
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
<li class="mb-2"><a href="./index.html">Home</a></li>
<li class="mb-2">
<a href="products.html">Products</a>
</li>
<li class="mb-2">
<a href="farmers.html">Farmers</a>
</li>
<li>
<a href="markets.html">Markets</a>
</li>
</ul>
</div>
<div class="col-6 col-lg-3">
<h5 class="fs-6">Customer</h5>
<ul class="list-unstyled small">
<li class="mb-2">
<a href="dashboard.html">Dashboard</a>
</li>
<li class="mb-2">
<a href="myorder.html">My Orders</a>
</li>
<li class="mb-2">
<a href="favorites.html">Favorites</a>
</li>
<li>
<a href="pre_orders.html">Pre-orders</a>
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
<script src="./assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>document.querySelectorAll(".order-action").forEach(function(btn){btn.addEventListener("click",function(){const action=btn.dataset.action;if(action==="filter"){alert("Order filter will be connected to the backend order data.");}else if(action==="details"){alert("Order details will be loaded from the backend for this order.");}else{alert("Order tracking will be connected to the backend order status.");}});});</script>
</body>
</html>