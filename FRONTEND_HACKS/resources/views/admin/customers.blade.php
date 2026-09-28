@extends('admin.master')

@section('title', 'Customers')

@section('main')

<main class="dashboard-content">

    {{-- =========================
         PAGE HEADER
    ========================== --}}
    <div class="welcome-section">
        <h1>Customers</h1>
        <p>Manage MarketLink customers and their accounts.</p>
    </div>


    {{-- =========================
         CUSTOMER STATISTICS
    ========================== --}}
    <div class="stats-grid">

        {{-- Total Customers --}}
        <div class="stat-card">
            <div class="stat-icon">
                👥
            </div>

            <div class="stat-info">
                <p>Total Customers</p>
                <h2>{{ $customers->count() }}</h2>
            </div>
        </div>


        {{-- Active Customers --}}
        <div class="stat-card">
            <div class="stat-icon">
                ✅
            </div>

            <div class="stat-info">
                <p>Active Customers</p>
                <h2>
                    {{ $customers->where('status', 'active')->count() }}
                </h2>
            </div>
        </div>


        {{-- Suspended Customers --}}
        <div class="stat-card">
            <div class="stat-icon">
                🚫
            </div>

            <div class="stat-info">
                <p>Suspended Customers</p>
                <h2>
                    {{ $customers->where('status', 'suspended')->count() }}
                </h2>
            </div>
        </div>

    </div>


    {{-- =========================
         ALL CUSTOMERS
    ========================== --}}
    <div class="dashboard-card">

        <div class="card-header">

            <div>
                <h3>All Customers</h3>
            </div>

            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

                {{-- Search --}}
                <input
                    type="text"
                    id="customerSearch"
                    placeholder="Search customers..."
                    style="
                        padding:10px 13px;
                        border:1px solid #ddd;
                        border-radius:7px;
                        min-width:220px;
                        outline:none;
                    "
                >


                {{-- Status Filter --}}
                <select
                    id="statusFilter"
                    style="
                        padding:10px 13px;
                        border:1px solid #ddd;
                        border-radius:7px;
                        outline:none;
                    "
                >
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                </select>


                {{-- Add Customer --}}
                <button
                    type="button"
                    class="approval-btn"
                    onclick="openAddCustomerModal()"
                >
                    + Add Customer
                </button>

            </div>

        </div>


        {{-- =========================
             SUCCESS MESSAGE
        ========================== --}}
        @if(session('success'))

            <div
                style="
                    background:#d4edda;
                    color:#155724;
                    padding:12px 15px;
                    border-radius:7px;
                    margin-bottom:18px;
                "
            >
                {{ session('success') }}
            </div>

        @endif


        {{-- =========================
             VALIDATION ERRORS
        ========================== --}}
        @if($errors->any())

            <div
                style="
                    background:#f8d7da;
                    color:#721c24;
                    padding:12px 15px;
                    border-radius:7px;
                    margin-bottom:18px;
                "
            >
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif


        {{-- =========================
             CUSTOMERS TABLE
        ========================== --}}
        <div style="overflow-x:auto;">

            <table class="orders-table customers-table">

                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Orders</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody id="customersTableBody">

                    @forelse($customers as $customer)

                        @php
                            $initials = collect(
                                preg_split('/\s+/', trim($customer->name))
                            )
                            ->filter()
                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                        @endphp


                        <tr
                            class="customer-row"
                            data-name="{{ strtolower($customer->name) }}"
                            data-email="{{ strtolower($customer->email) }}"
                            data-contact="{{ strtolower($customer->contact ?? '') }}"
                            data-address="{{ strtolower($customer->address ?? '') }}"
                            data-status="{{ strtolower($customer->status) }}"
                        >

                            {{-- Customer --}}
                            <td>

                                <div
                                    style="
                                        display:flex;
                                        align-items:center;
                                        gap:12px;
                                    "
                                >

                                    <div
                                        style="
                                            width:42px;
                                            height:42px;
                                            border-radius:50%;
                                            background:#e8f5e9;
                                            color:#388e3c;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            font-weight:bold;
                                        "
                                    >
                                        {{ $initials ?: 'C' }}
                                    </div>


                                    <div>

                                        <strong style="display:block;">
                                            {{ $customer->name }}
                                        </strong>

                                        <small style="color:#888;">
                                            {{ $customer->email }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Contact --}}
                            <td>
                                {{ $customer->contact ?: 'N/A' }}
                            </td>


                            {{-- Address --}}
                            <td>
                                {{ $customer->address ?: 'N/A' }}
                            </td>


                            {{-- Orders --}}
                            <td>
                                {{ $customer->orders_count ?? 0 }}
                            </td>


                            {{-- Status --}}
                            <td>

                                @if($customer->status === 'active')

                                    <span class="status confirmed">
                                        Active
                                    </span>

                                @else

                                    <span class="status cancelled">
                                        Suspended
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div style="display:flex; gap:6px; flex-wrap:wrap;">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.customer.details', $customer->id) }}"
                                        title="View Customer"
                                        style="
                                            display:inline-flex;
                                            align-items:center;
                                            justify-content:center;
                                            width:36px;
                                            height:36px;
                                            border-radius:6px;
                                            background:#e3f2fd;
                                            color:#1976d2;
                                        "
                                    >
                                        👁️
                                    </a>


                                    {{-- Edit --}}
                                    <button
                                        type="button"
                                        title="Edit Customer"
                                        onclick="openEditCustomerModal(
                                            {{ $customer->id }},
                                            @js($customer->name),
                                            @js($customer->email),
                                            @js($customer->contact),
                                            @js($customer->address),
                                            @js($customer->status)
                                        )"
                                        style="
                                            border:none;
                                            width:36px;
                                            height:36px;
                                            border-radius:6px;
                                            background:#fff3cd;
                                            color:#856404;
                                            cursor:pointer;
                                        "
                                    >
                                        ✏️
                                    </button>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.customers.destroy', $customer->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete {{ addslashes($customer->name) }}?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete Customer"
                                            style="
                                                border:none;
                                                width:36px;
                                                height:36px;
                                                border-radius:6px;
                                                background:#f8d7da;
                                                color:#721c24;
                                                cursor:pointer;
                                            "
                                        >
                                            🗑️
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                style="
                                    text-align:center;
                                    padding:35px;
                                    color:#777;
                                "
                            >
                                No customers found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>


{{-- =========================================================
     ADD / EDIT CUSTOMER MODAL
========================================================= --}}

<div
    id="customerModal"
    style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.45);
        z-index:2000;
        align-items:center;
        justify-content:center;
        padding:20px;
    "
>

    <div
        style="
            width:100%;
            max-width:600px;
            background:white;
            border-radius:12px;
            padding:25px;
            max-height:90vh;
            overflow-y:auto;
        "
    >

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:20px;
            "
        >

            <h2 id="customerModalTitle">
                Add Customer
            </h2>

            <button
                type="button"
                onclick="closeCustomerModal()"
                style="
                    border:none;
                    background:transparent;
                    font-size:25px;
                    cursor:pointer;
                "
            >
                &times;
            </button>

        </div>


        {{-- Add Form --}}
        <form
            id="addCustomerForm"
            action="{{ route('admin.customers.store') }}"
            method="POST"
        >

            @csrf

            <div style="margin-bottom:15px;">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    required
                    placeholder="Enter customer name"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Enter email"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Contact
                </label>

                <input
                    type="text"
                    name="contact"
                    placeholder="Enter contact number"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    placeholder="Enter customer address"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                        resize:vertical;
                    "
                ></textarea>

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    minlength="8"
                    placeholder="Leave blank for default password"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

                <small style="color:#888;">
                    If blank, the default password will be password123.
                </small>

            </div>


            <div style="margin-bottom:20px;">

                <label>
                    Status
                </label>

                <select
                    name="status"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >
                    <option value="active">
                        Active
                    </option>

                    <option value="suspended">
                        Suspended
                    </option>
                </select>

            </div>


            <div style="display:flex; gap:10px; justify-content:flex-end;">

                <button
                    type="button"
                    onclick="closeCustomerModal()"
                    style="
                        padding:10px 18px;
                        border:none;
                        border-radius:6px;
                        background:#eee;
                        cursor:pointer;
                    "
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="approval-btn"
                >
                    Add Customer
                </button>

            </div>

        </form>


        {{-- Edit Form --}}
        <form
            id="editCustomerForm"
            method="POST"
            style="display:none;"
        >

            @csrf
            @method('PUT')


            <div style="margin-bottom:15px;">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    id="editName"
                    name="name"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    id="editEmail"
                    name="email"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Contact
                </label>

                <input
                    type="text"
                    id="editContact"
                    name="contact"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    Address
                </label>

                <textarea
                    id="editAddress"
                    name="address"
                    rows="3"
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                        resize:vertical;
                    "
                ></textarea>

            </div>


            <div style="margin-bottom:20px;">

                <label>
                    Status
                </label>

                <select
                    id="editStatus"
                    name="status"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

                    <option value="active">
                        Active
                    </option>

                    <option value="suspended">
                        Suspended
                    </option>

                </select>

            </div>


            <div style="display:flex; gap:10px; justify-content:flex-end;">

                <button
                    type="button"
                    onclick="closeCustomerModal()"
                    style="
                        padding:10px 18px;
                        border:none;
                        border-radius:6px;
                        background:#eee;
                        cursor:pointer;
                    "
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="approval-btn"
                >
                    Update Customer
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
     SEARCH / FILTER / MODAL JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | Search Customers
    |--------------------------------------------------------------------------
    */

    const customerSearch = document.getElementById('customerSearch');

    const statusFilter = document.getElementById('statusFilter');

    const customerRows = document.querySelectorAll('.customer-row');


    function filterCustomers() {

        const searchValue =
            customerSearch.value.toLowerCase().trim();

        const statusValue =
            statusFilter.value.toLowerCase();


        customerRows.forEach(function(row) {

            const name =
                row.dataset.name || '';

            const email =
                row.dataset.email || '';

            const contact =
                row.dataset.contact || '';

            const address =
                row.dataset.address || '';

            const status =
                row.dataset.status || '';


            const matchesSearch =
                name.includes(searchValue) ||
                email.includes(searchValue) ||
                contact.includes(searchValue) ||
                address.includes(searchValue);


            const matchesStatus =
                statusValue === 'all' ||
                status === statusValue;


            row.style.display =
                matchesSearch && matchesStatus
                    ? ''
                    : 'none';

        });

    }


    customerSearch.addEventListener(
        'input',
        filterCustomers
    );


    statusFilter.addEventListener(
        'change',
        filterCustomers
    );


    /*
    |--------------------------------------------------------------------------
    | Add Customer Modal
    |--------------------------------------------------------------------------
    */

    function openAddCustomerModal() {

        document.getElementById('customerModal').style.display = 'flex';

        document.getElementById('customerModalTitle').textContent =
            'Add Customer';

        document.getElementById('addCustomerForm').style.display =
            'block';

        document.getElementById('editCustomerForm').style.display =
            'none';

    }


    /*
    |--------------------------------------------------------------------------
    | Edit Customer Modal
    |--------------------------------------------------------------------------
    */

    function openEditCustomerModal(
        id,
        name,
        email,
        contact,
        address,
        status
    ) {

        document.getElementById('customerModal').style.display = 'flex';

        document.getElementById('customerModalTitle').textContent =
            'Edit Customer';


        document.getElementById('addCustomerForm').style.display =
            'none';

        document.getElementById('editCustomerForm').style.display =
            'block';


        document.getElementById('editName').value =
            name || '';

        document.getElementById('editEmail').value =
            email || '';

        document.getElementById('editContact').value =
            contact || '';

        document.getElementById('editAddress').value =
            address || '';

        document.getElementById('editStatus').value =
            status || 'active';


        document.getElementById('editCustomerForm').action =
            "{{ url('/admin/customers') }}/" + id;

    }


    /*
    |--------------------------------------------------------------------------
    | Close Modal
    |--------------------------------------------------------------------------
    */

    function closeCustomerModal() {

        document.getElementById('customerModal').style.display =
            'none';

    }


    /*
    |--------------------------------------------------------------------------
    | Close Modal When Clicking Outside
    |--------------------------------------------------------------------------
    */

    document.getElementById('customerModal').addEventListener(
        'click',
        function(event) {

            if (event.target === this) {

                closeCustomerModal();

            }

        }
    );

</script>

@endpush

@endsection