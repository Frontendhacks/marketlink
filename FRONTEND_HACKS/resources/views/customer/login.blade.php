@extends('customer.master')

@section('main')

<link rel="stylesheet" href="{{ asset('customers/assets/css/login.css') }}">

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-5">
<div class="login-box shadow-sm p-4 p-md-5">
<div class="text-center mb-4">
<img alt="MarketLink" class="logo mb-3" src="{{ asset('customers/Images/logo.png') }}"/>
<h2 class="fw-bold">Customer Login</h2>
<p class="text-muted">Login to access your MarketLink account.</p>
</div>
<form action="{{ route('login.store') }}" method="POST">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label for="email" class="form-label">
            <b>Email</b>
        </label>

        <input
            class="form-control"
            id="email"
            name="email"
            placeholder="Enter your email"
            type="email"
            value="{{ old('email') }}"
            required
        >
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            <b>Password</b>
        </label>

        <input
            class="form-control"
            id="password"
            name="password"
            placeholder="Enter your password"
            type="password"
            required
        >
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input
                class="form-check-input"
                id="remember"
                name="remember"
                type="checkbox"
                value="1"
            >

            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>
    </div>

    <button class="btn btn-main w-100" type="submit">
        Login
    </button>
</form>
<p class="text-center mt-4 mb-0">
Don't have an account?
<a href="{{ route('register') }}">Create Account</a>
</p>
</div>
</div>
</div>
</div>

@endsection