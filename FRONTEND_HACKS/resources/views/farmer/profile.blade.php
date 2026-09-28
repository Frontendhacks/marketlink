@extends('farmer.master')
@section('title', 'My Profile')
@section('main')
@php $profile = $user->farmerProfile; @endphp
<div class="mb-4">
    <h1 class="fw-bold mb-1">My Profile</h1>
    <p class="text-muted">Manage your account and farm details.</p>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Account &amp; Farm Details <span class="badge bg-success ms-2">Approved</span></h5>
                <form method="POST" action="{{ route('farmer.profile.update') }}" class="row g-3">
                    @csrf @method('PUT')
                    <div class="col-md-6"><label class="form-label">Full name</label><input name="name" class="form-control" value="{{ old('name', $user->name) }}" required></div>
                    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
                    <div class="col-md-6"><label class="form-label">Phone</label><input name="contact" class="form-control" value="{{ old('contact', $user->contact) }}" required></div>
                    <div class="col-md-6"><label class="form-label">Address</label><input name="address" class="form-control" value="{{ old('address', $user->address) }}"></div>
                    <div class="col-md-6"><label class="form-label">Farm / stall name</label><input name="stall_name" class="form-control" value="{{ old('stall_name', $profile->stall_name ?? '') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Farm type</label><input name="farm_type" class="form-control" value="{{ old('farm_type', $profile->farm_type ?? '') }}"></div>
                    <div class="col-md-4"><label class="form-label">Farm size</label><input name="farm_size" class="form-control" value="{{ old('farm_size', $profile->farm_size ?? '') }}"></div>
                    <div class="col-md-4"><label class="form-label">City</label><input name="city" class="form-control" value="{{ old('city', $profile->city ?? '') }}"></div>
                    <div class="col-md-4">
                        <label class="form-label">Market</label>
                        <select name="market_id" class="form-select" required>
                            @foreach($markets as $market)
                                <option value="{{ $market->market_id }}" @selected(old('market_id', $profile->market_id ?? null) == $market->market_id)>{{ $market->market_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12"><label class="form-label">Description</label><textarea name="stall_description" rows="3" class="form-control">{{ old('stall_description', $profile->stall_description ?? '') }}</textarea></div>
                    <div class="col-12"><button class="btn btn-success">Save changes</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Change Password</h5>
                <form method="POST" action="{{ route('farmer.profile.password') }}">
                    @csrf @method('PUT')
                    <div class="mb-3"><label class="form-label">Current password</label><input type="password" name="current_password" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">New password</label><input type="password" name="password" class="form-control" minlength="8" required></div>
                    <div class="mb-3"><label class="form-label">Confirm new password</label><input type="password" name="password_confirmation" class="form-control" minlength="8" required></div>
                    <button class="btn btn-outline-success w-100">Update password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
