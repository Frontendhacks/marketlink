@extends('admin.master')

@section('title', 'Markets')

@section('main')

<section class="content">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div style="
            margin-bottom:20px;
            padding:14px 18px;
            border-radius:8px;
            background:#d1e7dd;
            color:#0f5132;
            border:1px solid #badbcc;
        ">
            {{ session('success') }}
        </div>
    @endif


    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div style="
            margin-bottom:20px;
            padding:14px 18px;
            border-radius:8px;
            background:#f8d7da;
            color:#842029;
            border:1px solid #f5c2c7;
        ">
            <strong>Please fix the following:</strong>

            <ul style="margin:8px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- PAGE HEADER --}}
    <div class="welcome-section">
        <h1>Markets</h1>
        <p>View and manage local markets.</p>
    </div>


    {{-- MARKET STATISTICS --}}
    <div class="market-stats">

        {{-- TOTAL --}}
        <div class="market-card">

            <div class="market-icon">
                📍
            </div>

            <div>
                <p>Total Markets</p>

                <h2>
                    {{ $markets->count() }}
                </h2>
            </div>

        </div>


        {{-- ACTIVE --}}
        <div class="market-card">

            <div class="market-icon">
                ✅
            </div>

            <div>
                <p>Active Markets</p>

                <h2>
                    {{ $markets->where('status', 'active')->count() }}
                </h2>
            </div>

        </div>


        {{-- INACTIVE --}}
        <div class="market-card">

            <div class="market-icon">
                ⏳
            </div>

            <div>
                <p>Inactive Markets</p>

                <h2>
                    {{ $markets->where('status', 'inactive')->count() }}
                </h2>
            </div>

        </div>

    </div>


    {{-- MARKETS TABLE --}}
    <div class="dashboard-card">

        <div class="card-header">

            <div>
                <h3>All Markets</h3>

                <p>
                    Manage local markets and their schedules.
                </p>
            </div>


            <div
                style="
                    display:flex;
                    align-items:center;
                    gap:10px;
                    flex-wrap:wrap;
                "
            >

                {{-- SEARCH --}}
                <div
                    class="market-search-box"
                    style="
                        display:flex;
                        align-items:center;
                        gap:8px;
                        width:250px;
                        height:40px;
                        padding:0 12px;
                        background:#f7f8f9;
                        border:1px solid #ddd;
                        border-radius:6px;
                    "
                >

                    <i
                        class="fa-solid fa-magnifying-glass"
                        style="color:#888;"
                    ></i>

                    <input
                        type="text"
                        id="marketSearch"
                        placeholder="Search market..."
                        style="
                            width:100%;
                            border:none;
                            outline:none;
                            background:transparent;
                            font-size:13px;
                        "
                    >

                </div>


                {{-- ADD MARKET --}}
                <button
                    type="button"
                    class="add-market-btn"
                    id="addMarketBtn"
                >
                    <i class="fa-solid fa-plus"></i>
                    Add Market
                </button>

            </div>

        </div>


        {{-- TABLE --}}
        <div style="overflow-x:auto;">

            <table class="markets-table">

                <thead>

                    <tr>

                        <th>Market Name</th>

                        <th>Address</th>

                        <th>Day</th>

                        <th>Timings</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody id="marketsTableBody">

                    @forelse($markets as $market)

                        <tr
                            class="market-row"
                            data-name="{{ strtolower($market->market_name) }}"
                            data-address="{{ strtolower($market->address) }}"
                            data-day="{{ strtolower($market->day) }}"
                            data-timing="{{ strtolower($market->timing) }}"
                            data-status="{{ strtolower($market->status) }}"
                        >

                            {{-- MARKET NAME --}}
                            <td>

                                <strong>
                                    {{ $market->market_name }}
                                </strong>

                            </td>


                            {{-- ADDRESS --}}
                            <td>
                                {{ $market->address }}
                            </td>


                            {{-- DAY --}}
                            <td>
                                {{ $market->day }}
                            </td>


                            {{-- TIMING --}}
                            <td>
                                {{ $market->timing }}
                            </td>


                            {{-- STATUS --}}
                            <td>

                                <span
                                    class="market-status {{ strtolower($market->status) }}"
                                >
                                    {{ ucfirst($market->status) }}
                                </span>

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div
                                    style="
                                        display:flex;
                                        gap:5px;
                                        align-items:center;
                                    "
                                >

                                    {{-- VIEW --}}
                                    <button
                                        type="button"
                                        class="view-market-btn"
                                        title="View"
                                        data-name="{{ $market->market_name }}"
                                        data-address="{{ $market->address }}"
                                        data-day="{{ $market->day }}"
                                        data-timing="{{ $market->timing }}"
                                        data-status="{{ $market->status }}"
                                        data-latitude="{{ $market->latitude }}"
                                        data-longitude="{{ $market->longitude }}"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </button>


                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        class="edit-market-btn"
                                        title="Edit"

                                        data-id="{{ $market->market_id }}"
                                        data-name="{{ $market->market_name }}"
                                        data-address="{{ $market->address }}"
                                        data-day="{{ $market->day }}"
                                        data-timing="{{ $market->timing }}"
                                        data-status="{{ $market->status }}"
                                        data-latitude="{{ $market->latitude }}"
                                        data-longitude="{{ $market->longitude }}"
                                        data-map-provider="{{ $market->map_provider }}"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </button>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.markets.destroy', $market->market_id) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete {{ addslashes($market->market_name) }}?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-market-btn"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="no-markets"
                            >

                                <i class="fa-solid fa-location-dot"></i>

                                <p>
                                    No markets found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- ADD MARKET MODAL --}}
{{-- ========================================================= --}}

<div
    id="addMarketModal"
    class="market-modal-overlay"
    style="display:none;"
>

    <div class="market-modal">

        <div class="modal-header">

            <h2>
                <i class="fa-solid fa-location-dot"></i>
                Add Market
            </h2>

            <button
                type="button"
                class="close-market-modal"
                data-modal="addMarketModal"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <form
                action="{{ route('admin.markets.store') }}"
                method="POST"
                class="market-form"
            >

                @csrf


                {{-- MARKET NAME --}}
                <div>

                    <label>
                        Market Name
                    </label>

                    <input
                        type="text"
                        name="market_name"
                        placeholder="Enter market name"
                        value="{{ old('market_name') }}"
                        required
                    >

                </div>


                {{-- ADDRESS --}}
                <div>

                    <label>
                        Address
                    </label>

                    <input
                        type="text"
                        name="address"
                        placeholder="Enter address"
                        value="{{ old('address') }}"
                        required
                    >

                </div>


                {{-- DAY --}}
                <div>

                    <label>
                        Day
                    </label>

                    <input
                        type="text"
                        name="day"
                        placeholder="e.g. Sunday"
                        value="{{ old('day') }}"
                        required
                    >

                </div>


                {{-- TIMING --}}
                <div>

                    <label>
                        Timings
                    </label>

                    <input
                        type="text"
                        name="timing"
                        placeholder="e.g. 8 AM - 2 PM"
                        value="{{ old('timing') }}"
                        required
                    >

                </div>


                {{-- STATUS --}}
                <div>

                    <label>
                        Status
                    </label>

                    <select
                        name="status"
                        required
                    >

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- MAP PROVIDER --}}
                <div>

                    <label>
                        Map Provider
                    </label>

                    <input
                        type="text"
                        name="map_provider"
                        placeholder="e.g. Google Maps"
                        value="{{ old('map_provider') }}"
                    >

                </div>


                {{-- LATITUDE --}}
                <div>

                    <label>
                        Latitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        name="latitude"
                        placeholder="e.g. 24.8607"
                        value="{{ old('latitude') }}"
                    >

                </div>


                {{-- LONGITUDE --}}
                <div>

                    <label>
                        Longitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        name="longitude"
                        placeholder="e.g. 67.0011"
                        value="{{ old('longitude') }}"
                    >

                </div>


                {{-- BUTTONS --}}
                <div class="modal-actions full">

                    <button
                        type="button"
                        class="modal-btn cancel-btn"
                        data-modal="addMarketModal"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="modal-btn save-btn"
                    >
                        Add Market
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- EDIT MARKET MODAL --}}
{{-- ========================================================= --}}

<div
    id="editMarketModal"
    class="market-modal-overlay"
    style="display:none;"
>

    <div class="market-modal">

        <div class="modal-header">

            <h2>
                <i class="fa-solid fa-pen"></i>
                Edit Market
            </h2>

            <button
                type="button"
                class="close-market-modal"
                data-modal="editMarketModal"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <form
                id="editMarketForm"
                method="POST"
                class="market-form"
            >

                @csrf

                @method('PUT')


                {{-- MARKET NAME --}}
                <div>

                    <label>
                        Market Name
                    </label>

                    <input
                        type="text"
                        name="market_name"
                        id="editMarketName"
                        required
                    >

                </div>


                {{-- ADDRESS --}}
                <div>

                    <label>
                        Address
                    </label>

                    <input
                        type="text"
                        name="address"
                        id="editMarketAddress"
                        required
                    >

                </div>


                {{-- DAY --}}
                <div>

                    <label>
                        Day
                    </label>

                    <input
                        type="text"
                        name="day"
                        id="editMarketDay"
                        required
                    >

                </div>


                {{-- TIMING --}}
                <div>

                    <label>
                        Timings
                    </label>

                    <input
                        type="text"
                        name="timing"
                        id="editMarketTiming"
                        required
                    >

                </div>


                {{-- STATUS --}}
                <div>

                    <label>
                        Status
                    </label>

                    <select
                        name="status"
                        id="editMarketStatus"
                        required
                    >

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- MAP PROVIDER --}}
                <div>

                    <label>
                        Map Provider
                    </label>

                    <input
                        type="text"
                        name="map_provider"
                        id="editMarketMapProvider"
                    >

                </div>


                {{-- LATITUDE --}}
                <div>

                    <label>
                        Latitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        name="latitude"
                        id="editMarketLatitude"
                    >

                </div>


                {{-- LONGITUDE --}}
                <div>

                    <label>
                        Longitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        name="longitude"
                        id="editMarketLongitude"
                    >

                </div>


                {{-- BUTTONS --}}
                <div class="modal-actions full">

                    <button
                        type="button"
                        class="modal-btn cancel-btn"
                        data-modal="editMarketModal"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="modal-btn save-btn"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- VIEW MARKET MODAL --}}
{{-- ========================================================= --}}

<div
    id="viewMarketModal"
    class="market-modal-overlay"
    style="display:none;"
>

    <div class="market-modal">

        <div class="modal-header">

            <h2>
                <i class="fa-solid fa-location-dot"></i>
                Market Details
            </h2>

            <button
                type="button"
                class="close-market-modal"
                data-modal="viewMarketModal"
            >
                ×
            </button>

        </div>


        <div
            id="marketDetails"
            class="market-details"
        ></div>


        <div class="modal-actions">

            <button
                type="button"
                class="modal-btn cancel-btn"
                data-modal="viewMarketModal"
            >
                Close
            </button>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MARKET CSS --}}
{{-- ========================================================= --}}

<style>
    /* =========================
       MARKETS PAGE
    ========================= */

    .markets-page {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    /* Stats */
    .market-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
        width: 100%;
        margin-bottom: 30px;
    }

    .market-stats .stat-card {
        min-width: 0;
        width: 100%;
        box-sizing: border-box;
    }

    /* Page Header */
    .market-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        margin-bottom: 22px;
        box-sizing: border-box;
    }

    .market-page-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #222;
    }

    .market-page-header p {
        margin: 5px 0 0;
        color: #777;
        font-size: 15px;
    }

    .market-header-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }

    .market-search-box {
        width: 360px;
        max-width: 100%;
    }

    .market-search-box input {
        width: 100%;
        height: 48px;
        padding: 0 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        box-sizing: border-box;
    }

    .market-search-box input:focus {
        border-color: #4caf50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.10);
    }

    .add-market-btn {
        height: 48px;
        padding: 0 24px;
        border: none;
        border-radius: 8px;
        background: #4caf50;
        color: white;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .add-market-btn:hover {
        background: #43a047;
    }

    /* Table Card */
    .market-card {
        width: 100%;
        max-width: 100%;
        overflow: hidden;
        box-sizing: border-box;
    }

    .markets-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .markets-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }

    .markets-table th {
        background: #f7f8f9;
        color: #444;
        font-size: 14px;
        font-weight: 700;
        padding: 18px 20px;
        text-align: left;
        border-bottom: 1px solid #e5e5e5;
        white-space: nowrap;
    }

    .markets-table td {
        padding: 18px 20px;
        color: #555;
        font-size: 15px;
        border-bottom: 1px solid #eeeeee;
        vertical-align: middle;
    }

    .markets-table tbody tr:last-child td {
        border-bottom: none;
    }

    .markets-table tbody tr:hover {
        background: #fafafa;
    }

    /* Status */
    .market-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 104px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .market-status.active {
        color: #198754;
        background: #e8f5e9;
    }

    .market-status.inactive {
        color: #dc3545;
        background: #fdecec;
    }

    /* Action Buttons */
    .market-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .market-action-btn {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 15px;
    }

    .market-view-btn {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .market-edit-btn {
        background: #fff3cd;
        color: #856404;
    }

    .market-delete-btn {
        background: #fdecec;
        color: #dc3545;
    }

    /* Modal */
    .market-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, 0.45);
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .market-modal.show {
        display: flex;
    }

    .market-modal-content {
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .market-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px;
        border-bottom: 1px solid #eee;
    }

    .market-modal-header h2 {
        margin: 0;
        font-size: 21px;
        color: #222;
    }

    .market-modal-close {
        border: none;
        background: transparent;
        font-size: 25px;
        color: #777;
        cursor: pointer;
    }

    .market-modal-body {
        padding: 24px;
    }

    .market-form-group {
        margin-bottom: 17px;
    }

    .market-form-group label {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    .market-form-group input,
    .market-form-group select,
    .market-form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #ddd;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
    }

    .market-form-group input:focus,
    .market-form-group select:focus,
    .market-form-group textarea:focus {
        border-color: #4caf50;
    }

    .market-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 18px 24px;
        border-top: 1px solid #eee;
    }

    .market-btn-cancel,
    .market-btn-save {
        padding: 10px 20px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .market-btn-cancel {
        border: 1px solid #ddd;
        background: white;
        color: #555;
    }

    .market-btn-save {
        border: none;
        background: #4caf50;
        color: white;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1200px) {
        .market-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .market-page-header {
            align-items: flex-start;
        }

        .market-header-actions {
            flex-wrap: wrap;
        }

        .market-search-box {
            width: 280px;
        }
    }

    @media (max-width: 768px) {
        .market-stats {
            grid-template-columns: 1fr;
        }

        .market-page-header {
            flex-direction: column;
        }

        .market-header-actions {
            width: 100%;
        }

        .market-search-box {
            width: 100%;
        }

        .add-market-btn {
            width: 100%;
        }
    }
</style>

{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | ADD MARKET
    |--------------------------------------------------------------------------
    */

    const addMarketBtn =
        document.getElementById('addMarketBtn');

    const addMarketModal =
        document.getElementById('addMarketModal');


    if (addMarketBtn && addMarketModal) {

        addMarketBtn.addEventListener('click', function () {

            addMarketModal.style.display = 'flex';

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODALS
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('[data-modal]')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const modalId =
                    this.dataset.modal;

                const modal =
                    document.getElementById(modalId);

                if (modal) {

                    modal.style.display = 'none';

                }

            });

        });


    /*
    |--------------------------------------------------------------------------
    | CLICK OUTSIDE MODAL
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.market-modal-overlay')
        .forEach(function (modal) {

            modal.addEventListener('click', function (event) {

                if (event.target === modal) {

                    modal.style.display = 'none';

                }

            });

        });


    /*
    |--------------------------------------------------------------------------
    | VIEW MARKET
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.view-market-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const name =
                    this.dataset.name || 'N/A';

                const address =
                    this.dataset.address || 'N/A';

                const day =
                    this.dataset.day || 'N/A';

                const timing =
                    this.dataset.timing || 'N/A';

                const status =
                    this.dataset.status || 'N/A';

                const latitude =
                    this.dataset.latitude || 'Not provided';

                const longitude =
                    this.dataset.longitude || 'Not provided';


                document.getElementById(
                    'marketDetails'
                ).innerHTML = `

                    <div class="detail-row">
                        <strong>Market Name</strong>
                        <span>${escapeHtml(name)}</span>
                    </div>

                    <div class="detail-row">
                        <strong>Address</strong>
                        <span>${escapeHtml(address)}</span>
                    </div>

                    <div class="detail-row">
                        <strong>Day</strong>
                        <span>${escapeHtml(day)}</span>
                    </div>

                    <div class="detail-row">
                        <strong>Timings</strong>
                        <span>${escapeHtml(timing)}</span>
                    </div>

                    <div class="detail-row">
                        <strong>Status</strong>
                        <span>${escapeHtml(status)}</span>
                    </div>

                    <div class="detail-row">
                        <strong>Latitude</strong>
                        <span>${escapeHtml(latitude)}</span>
                    </div>

                    <div class="detail-row">
                        <strong>Longitude</strong>
                        <span>${escapeHtml(longitude)}</span>
                    </div>

                `;


                document.getElementById(
                    'viewMarketModal'
                ).style.display = 'flex';

            });

        });


    /*
    |--------------------------------------------------------------------------
    | EDIT MARKET
    |--------------------------------------------------------------------------
    */

    const editMarketForm =
        document.getElementById(
            'editMarketForm'
        );


    document
        .querySelectorAll('.edit-market-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const id =
                    this.dataset.id;

                const name =
                    this.dataset.name || '';

                const address =
                    this.dataset.address || '';

                const day =
                    this.dataset.day || '';

                const timing =
                    this.dataset.timing || '';

                const status =
                    this.dataset.status || 'active';

                const latitude =
                    this.dataset.latitude || '';

                const longitude =
                    this.dataset.longitude || '';

                const mapProvider =
                    this.dataset.mapProvider || '';


                /*
                | Form Action
                */

                editMarketForm.action =
                    "{{ url('/admin/markets') }}/" + id;


                /*
                | Form Fields
                */

                document.getElementById(
                    'editMarketName'
                ).value = name;

                document.getElementById(
                    'editMarketAddress'
                ).value = address;

                document.getElementById(
                    'editMarketDay'
                ).value = day;

                document.getElementById(
                    'editMarketTiming'
                ).value = timing;

                document.getElementById(
                    'editMarketStatus'
                ).value = status;

                document.getElementById(
                    'editMarketMapProvider'
                ).value = mapProvider;

                document.getElementById(
                    'editMarketLatitude'
                ).value = latitude;

                document.getElementById(
                    'editMarketLongitude'
                ).value = longitude;


                /*
                | Open Modal
                */

                document.getElementById(
                    'editMarketModal'
                ).style.display = 'flex';

            });

        });


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById(
            'marketSearch'
        );


    const rows =
        document.querySelectorAll(
            '.market-row'
        );


    if (searchInput) {

        searchInput.addEventListener(
            'input',
            function () {

                const search =
                    this.value
                        .toLowerCase()
                        .trim();


                rows.forEach(function (row) {

                    const name =
                        row.dataset.name || '';

                    const address =
                        row.dataset.address || '';

                    const day =
                        row.dataset.day || '';

                    const timing =
                        row.dataset.timing || '';

                    const status =
                        row.dataset.status || '';


                    const matches =
                        name.includes(search) ||
                        address.includes(search) ||
                        day.includes(search) ||
                        timing.includes(search) ||
                        status.includes(search);


                    row.style.display =
                        matches ? '' : 'none';

                });

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                document
                    .querySelectorAll(
                        '.market-modal-overlay'
                    )
                    .forEach(function (modal) {

                        modal.style.display = 'none';

                    });

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | HTML ESCAPE
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }

});

</script>

@endpush

@endsection