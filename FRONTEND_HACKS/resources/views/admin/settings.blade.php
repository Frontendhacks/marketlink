@extends('admin.master')
@section('title', 'Settings')
@section('main')
<div class="dashboard-content">
    <div class="page-header">
        <h1>Settings</h1>
        <p>Update your administrator profile and password.</p>
    </div>

    @include('admin.partials.flash')

    <div class="two-col">
        <div class="dashboard-card">
            <div class="card-header"><h3>Profile</h3></div>
            <form method="POST" action="{{ route('admin.settings.profile') }}">
                @csrf @method('PUT')
                <div class="form-grid">
                    <div><label>Name</label><input name="name" value="{{ old('name', $admin->name) }}" required></div>
                    <div><label>Email</label><input type="email" name="email" value="{{ old('email', $admin->email) }}" required></div>
                    <div><label>Contact</label><input name="contact" value="{{ old('contact', $admin->contact) }}"></div>
                    <div><label>Address</label><input name="address" value="{{ old('address', $admin->address) }}"></div>
                </div>
                <div class="modal-actions"><button class="btn">Save Profile</button></div>
            </form>
        </div>

        <div class="dashboard-card">
            <div class="card-header"><h3>Change password</h3></div>
            <form method="POST" action="{{ route('admin.settings.password') }}">
                @csrf @method('PUT')
                <div class="form-grid">
                    <div class="full"><label>Current password</label><input type="password" name="current_password" required></div>
                    <div><label>New password</label><input type="password" name="password" minlength="8" required></div>
                    <div><label>Confirm new password</label><input type="password" name="password_confirmation" minlength="8" required></div>
                </div>
                <div class="modal-actions"><button class="btn">Update Password</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
