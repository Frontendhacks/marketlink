@extends('admin.master')
@section('title', 'Farmers')
@section('main')
<div class="dashboard-content">

    <div class="page-header">
        <h1>Farmers</h1>
        <p>Review registrations and control who can access the Farmer Dashboard.</p>
    </div>

    @include('admin.partials.flash')

    <div class="stats-grid cols-5">
        <div class="stat-card"><div class="stat-info"><p>Total Farmers</p><h2>{{ $stats['total'] }}</h2></div><div class="stat-icon">👨‍🌾</div></div>
        <div class="stat-card"><div class="stat-info"><p>Pending</p><h2>{{ $stats['pending'] }}</h2></div><div class="stat-icon">⏳</div></div>
        <div class="stat-card"><div class="stat-info"><p>Approved</p><h2>{{ $stats['approved'] }}</h2></div><div class="stat-icon">✅</div></div>
        <div class="stat-card"><div class="stat-info"><p>Rejected</p><h2>{{ $stats['rejected'] }}</h2></div><div class="stat-icon">🚫</div></div>
        <div class="stat-card"><div class="stat-info"><p>Inactive</p><h2>{{ $stats['inactive'] }}</h2></div><div class="stat-icon">💤</div></div>
    </div>

    <div class="tabs">
        <a href="{{ route('admin.farmers', array_filter(['q' => $search])) }}" class="{{ !$status ? 'active' : '' }}">All ({{ $stats['total'] }})</a>
        @foreach(['pending', 'approved', 'rejected', 'inactive'] as $tab)
            <a href="{{ route('admin.farmers', array_filter(['status' => $tab, 'q' => $search])) }}" class="{{ $status === $tab ? 'active' : '' }}">{{ ucfirst($tab) }} ({{ $stats[$tab] }})</a>
        @endforeach
    </div>

    <div class="dashboard-card">
        <div class="toolbar">
            <form method="GET" action="{{ route('admin.farmers') }}">
                @if($status)<input type="hidden" name="status" value="{{ $status }}">@endif
                <input type="text" name="q" value="{{ $search }}" placeholder="Search name, email, phone, farm, city...">
                <button class="btn" type="submit">Search</button>
                @if($search || $status)<a class="btn light" href="{{ route('admin.farmers') }}">Reset</a>@endif
            </form>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead>
                    <tr><th>Farmer</th><th>Contact</th><th>Farm / Stall</th><th>Market</th><th>Products</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                @forelse($farmers as $farmer)
                    @php
                        $profile = $farmer->farmerProfile;
                        $initials = collect(preg_split('/\s+/', trim($farmer->name)))->filter()->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
                        $fill = json_encode([
                            'name' => $farmer->name, 'email' => $farmer->email, 'contact' => $farmer->contact,
                            'address' => $farmer->address, 'stall_name' => $profile->stall_name ?? '',
                            'city' => $profile->city ?? '', 'market_id' => $profile->market_id ?? '',
                        ], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG);
                    @endphp
                    <tr>
                        <td><div class="cell-user"><div class="avatar">{{ $initials }}</div><div><strong>{{ $farmer->name }}</strong><div class="muted">{{ $farmer->email }}</div></div></div></td>
                        <td>{{ $farmer->contact ?: '—' }}<div class="muted">{{ \Illuminate\Support\Str::limit($farmer->address, 28) }}</div></td>
                        <td>{{ $profile->stall_name ?? '—' }}<div class="muted">{{ $profile->farm_type ?? '' }} {{ $profile?->city ? '· ' . $profile->city : '' }}</div></td>
                        <td>{{ $profile->market->market_name ?? '—' }}</td>
                        <td>{{ $farmer->products_count }}</td>
                        <td><span class="badge {{ $farmer->approval_status }}">{{ ucfirst($farmer->approval_status) }}</span></td>
                        <td>
                            <div class="row-actions">
                                <a class="btn sm info" href="{{ route('admin.farmer.details', $farmer) }}">View</a>
                                <button type="button" class="btn sm light" data-modal-open="editFarmerModal" data-action="{{ route('admin.farmers.update', $farmer) }}" data-fill='{{ $fill }}'>Edit</button>

                                @if(in_array($farmer->approval_status, ['pending', 'rejected', 'inactive'], true))
                                    <form method="POST" action="{{ route('admin.farmers.approve', $farmer) }}">@csrf<button class="btn sm">{{ $farmer->approval_status === 'pending' ? 'Approve' : 'Re-approve' }}</button></form>
                                @endif
                                @if($farmer->approval_status === 'pending')
                                    <form method="POST" action="{{ route('admin.farmers.reject', $farmer) }}" data-confirm="Reject {{ $farmer->name }}'s registration?">@csrf<button class="btn sm warning">Reject</button></form>
                                @endif
                                @if($farmer->approval_status === 'approved')
                                    <form method="POST" action="{{ route('admin.farmers.deactivate', $farmer) }}" data-confirm="Deactivate {{ $farmer->name }}? They will lose dashboard access.">@csrf<button class="btn sm warning">Deactivate</button></form>
                                @endif
                                <form method="POST" action="{{ route('admin.farmers.destroy', $farmer) }}" data-confirm="Permanently delete {{ $farmer->name }} and all their products?">@csrf @method('DELETE')<button class="btn sm danger">Delete</button></form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty">No farmers found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @include('admin.partials.pagination', ['paginator' => $farmers])
    </div>
</div>

<div class="modal-overlay" id="editFarmerModal">
    <div class="modal-box">
        <h3>Edit Farmer</h3>
        <form method="POST" action="#">
            @csrf @method('PUT')
            <div class="form-grid">
                <div><label>Name</label><input name="name" required maxlength="255"></div>
                <div><label>Email</label><input type="email" name="email" required></div>
                <div><label>Phone</label><input name="contact" required maxlength="20"></div>
                <div><label>City</label><input name="city" maxlength="100"></div>
                <div><label>Farm / Stall name</label><input name="stall_name" required maxlength="100"></div>
                <div>
                    <label>Market</label>
                    <select name="market_id" required>
                        @foreach($markets as $market)<option value="{{ $market->market_id }}">{{ $market->market_name }}</option>@endforeach
                    </select>
                </div>
                <div class="full"><label>Address</label><input name="address" maxlength="500"></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn secondary" data-modal-close>Cancel</button>
                <button class="btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
