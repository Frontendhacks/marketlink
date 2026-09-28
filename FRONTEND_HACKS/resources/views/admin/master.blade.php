<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>MarketLink - Admin Dashboard</title>

    {{-- Favicon --}}
    <link href="{{ asset('customers/Images/logo.png') }}" rel="icon" type="image/png"/>

    {{-- Admin CSS --}}
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"/>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7f9;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e5e5e5;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .logo {
            padding: 25px 20px;
            border-bottom: 1px solid #eeeeee;
            text-align: center;
        }

        .logo h1 {
            font-size: 25px;
            color: #333;
        }

        .logo h1 span {
            color: #4caf50;
        }

        .logo p {
            font-size: 13px;
            color: #888;
            margin-top: 5px;
        }

        .sidebar-nav {
            padding: 20px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            margin-bottom: 6px;
            border-radius: 8px;
            color: #555;
            font-size: 15px;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            background: #f0f8f0;
            color: #4caf50;
        }

        .nav-link.active {
            background: #4caf50;
            color: white;
        }

        .nav-link .icon {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .sidebar-bottom {
            padding: 15px;
            border-top: 1px solid #eeeeee;
        }

        .sidebar-bottom form {
            margin: 0;
        }

        .sidebar-bottom button {
            width: 100%;
            padding: 12px;
            border: none;
            background: transparent;
            color: #555;
            text-align: left;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .sidebar-bottom button:hover {
            background: #fff1f1;
            color: #e53935;
        }

        .dashboard-content {
            margin-left: 250px;
            padding: 30px;
            background: #f5f7f9;
            min-height: 100vh;
        }

        .welcome-section {
            margin-bottom: 25px;
        }

        .welcome-section h1 {
            margin: 0 0 8px 0;
            font-size: 28px;
            color: #333333;
        }

        .welcome-section p {
            margin: 0;
            font-size: 14px;
            color: #777777;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            min-height: 125px;
            padding: 22px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #eeeeee;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
            transition: 0.3s ease;
            background-color: lightcyan;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.10);
        }

        .stat-info p {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #666;
        }

        .stat-info h2 {
            margin: 0;
            font-size: 28px;
            color: #222;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.65);
            font-size: 28px;
            position: static !important;
        }

        .dashboard-card {
            background: #ffffff;
            padding: 22px;
            margin-bottom: 25px;
            border-radius: 12px;
            border: 1px solid #eeeeee;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 18px;
            color: #333333;
        }

        .card-header a {
            color: #4caf50;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .card-header a:hover {
            text-decoration: underline;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            padding: 14px 12px;
            background: #f8f9fa;
            color: #666;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            border-bottom: 1px solid #eeeeee;
        }

        .orders-table td {
            padding: 14px 12px;
            color: #444444;
            font-size: 14px;
            border-bottom: 1px solid #eeeeee;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tbody tr:hover {
            background: #fafafa;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.confirmed {
            background: #d4edda;
            color: #155724;
        }

        .status.completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .Approval {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eeeeee;
        }

        .Approval:last-child {
            border-bottom: none;
        }

        .Farmer-avatar {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e8f5e9;
            color: #388e3c;
            font-size: 14px;
            font-weight: bold;
            margin-right: 14px;
        }

        .Farmer-details {
            flex: 1;
        }

        .Farmer-details strong {
            display: block;
            font-size: 15px;
            color: #333333;
            margin-bottom: 4px;
        }

        .Farmer-details span {
            display: block;
            font-size: 13px;
            color: #888888;
        }

        .approval-btn {
            background: #4caf50;
            color: white;
            border: none;
            padding: 9px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .approval-btn:hover {
            background: #43a047;
        }

        @media (max-width:1000px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width:700px) {
            .sidebar {
                width: 220px;
            }

            .dashboard-content {
                margin-left: 220px;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .orders-table {
                display: block;
                overflow-x: auto;
            }

            .Approval {
                flex-wrap: wrap;
                gap: 10px;
            }
        }

        @media (max-width:550px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar-nav {
                padding: 10px 12px;
            }

            .dashboard-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="dashboard">

    {{-- =========================
         ADMIN SIDEBAR
    ========================== --}}
    <aside class="sidebar" id="sidebar">

        <div class="logo">
            <h1>Market<span>Link</span></h1>
            <p>Admin Panel</p>
        </div>

        <nav class="sidebar-nav">

            {{-- Dashboard --}}
            <a
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}"
            >
                <span class="icon">🏠</span>
                <span>Dashboard</span>
            </a>

            {{-- Farmers --}}
            @php $pendingFarmerCount = \App\Models\User::where('role', 'farmer')->where('approval_status', 'pending')->count(); @endphp
            <a
                class="nav-link {{ request()->routeIs('admin.farmers*') ? 'active' : '' }}"
                href="{{ route('admin.farmers') }}"
            >
                <span class="icon">👨‍🌾</span>
                <span>Farmers @if($pendingFarmerCount)<span class="badge pending" style="margin-left:6px;">{{ $pendingFarmerCount }}</span>@endif</span>
            </a>

            {{-- Customers --}}
            <a
                class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}"
                href="{{ route('admin.customers') }}"
            >
                <span class="icon">👥</span>
                <span>Customers</span>
            </a>

            {{-- Markets --}}
            <a
                class="nav-link {{ request()->routeIs('admin.markets*') ? 'active' : '' }}"
                href="{{ route('admin.markets') }}"
            >
                <span class="icon">📍</span>
                <span>Markets</span>
            </a>

            {{-- Categories --}}
            <a
                class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}"
                href="{{ route('admin.categories') }}"
            >
                <span class="icon">🏷️</span>
                <span>Categories</span>
            </a>

            {{-- Products --}}
            <a
                class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}"
                href="{{ route('admin.products') }}"
            >
                <span class="icon">📦</span>
                <span>Products</span>
            </a>

            {{-- Orders --}}
            <a
                class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}"
                href="{{ route('admin.orders') }}"
            >
                <span class="icon">🛒</span>
                <span>Orders</span>
            </a>

            {{-- Reports --}}
            <a
                class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}"
                href="{{ route('admin.reports') }}"
            >
                <span class="icon">📊</span>
                <span>Reports</span>
            </a>

            {{-- Settings --}}
            <a
                class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
                href="{{ route('admin.settings') }}"
            >
                <span class="icon">⚙️</span>
                <span>Settings</span>
            </a>

        </nav>

        {{-- =========================
             LOGOUT
        ========================== --}}
        <div class="sidebar-bottom">

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button type="submit">
                    <span>🚪</span>
                    Logout
                </button>
            </form>

        </div>

    </aside>

</div>


{{-- =========================
     PAGE CONTENT
========================== --}}

@yield('main')


{{-- =========================
     PAGE SCRIPTS
========================== --}}

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')

</body>
</html>