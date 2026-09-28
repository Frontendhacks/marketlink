@extends('farmer.master')
@section('title', 'FarmHub Farmer Registration')
@section('bare', '1')
@section('main')


<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:15px;margin:-30px;background:#f5f7fb;position:relative;overflow:hidden;">

    <video autoplay muted loop playsinline style="position:fixed;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;">
        <source src="{{ asset('farmers/vedio/background vedio.mp4') }}" type="video/mp4">
    </video>

    <div style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.45);z-index:1;"></div>

    <div class="container" style="padding:15px;position:relative;z-index:2;">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">

                <div style="background:rgba(186,241,208,0.95);border-radius:15px;padding:20px;box-shadow:0 5px 20px rgba(0,0,0,0.2);">

                    <div style="text-align:center;margin-bottom:25px;">
                        <div style="width:55px;height:55px;background:#e5f3ee;border-radius:50%;margin:auto;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-plus-fill" style="font-size:25px;color:#0b2f2a;"></i>
                        </div>

                        <h2 style="color:#0b2f2a;margin-top:12px;margin-bottom:5px;font-weight:700;">
                            Farmer Registration
                        </h2>

                        <p style="color:#000;margin:0;">
                            Create your FarmHub farmer account
                        </p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('farmer.register.store') }}" method="POST" id="registerForm">
                        @csrf

                        <h5 style="color:#0b2f2a;font-weight:600;margin-bottom:15px;">
                            <i class="bi bi-person"></i> Personal Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Full Name</label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter your full name"
                                    value="{{ old('name') }}"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Phone Number</label>

                                <input
    type="tel"
    id="contact"
    name="contact"
    class="form-control"
    placeholder="03XX-XXXXXXX"
    value="{{ old('contact') }}"
    style="padding:11px;border-radius:8px;"
    required
>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Email Address</label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="example@gmail.com"
                                    value="{{ old('email') }}"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                        </div>

                        <h5 style="color:#0b2f2a;font-weight:600;margin-top:15px;margin-bottom:15px;">
                            <i class="bi bi-tree-fill"></i> Farm Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Farm Name</label>

                                <input
                                    type="text"
                                    name="farm_name"
                                    class="form-control"
                                    placeholder="Enter farm name"
                                    value="{{ old('farm_name') }}"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Farm Type</label>

                                <select name="farm_type" class="form-select" style="padding:11px;border-radius:8px;" required>
                                    <option value="">Select farm type</option>
                                    <option value="Vegetable" {{ old('farm_type') == 'Vegetable' ? 'selected' : '' }}>Vegetable Farm</option>
                                    <option value="Fruit" {{ old('farm_type') == 'Fruit' ? 'selected' : '' }}>Fruit Farm</option>
                                    <option value="Grain" {{ old('farm_type') == 'Grain' ? 'selected' : '' }}>Grain Farm</option>
                                    <option value="Mixed" {{ old('farm_type') == 'Mixed' ? 'selected' : '' }}>Mixed Farming</option>
                                    <option value="Livestock" {{ old('farm_type') == 'Livestock' ? 'selected' : '' }}>Livestock Farm</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">City</label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    placeholder="Enter city"
                                    value="{{ old('city') }}"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Market</label>
                                <select name="market_id" class="form-select" style="padding:11px;border-radius:8px;" required>
                                    <option value="">Select market</option>
                                    @foreach($markets ?? [] as $market)
                                        <option value="{{ $market->market_id }}" {{ old('market_id') == $market->market_id ? 'selected' : '' }}>{{ $market->market_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Farm Size</label>

                                <input
                                    type="text"
                                    name="farm_size"
                                    class="form-control"
                                    placeholder="e.g. 10 acres"
                                    value="{{ old('farm_size') }}"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                        </div>

                        <h5 style="color:#0b2f2a;font-weight:600;margin-top:15px;margin-bottom:15px;">
                            <i class="bi bi-shield-lock-fill"></i> Account Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Password</label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Create password"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label style="font-weight:600;margin-bottom:7px;">Confirm Password</label>

                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm password"
                                    style="padding:11px;border-radius:8px;"
                                    required
                                >
                            </div>

                        </div>

                        <input type="hidden" name="role" value="farmer">

                        <div style="margin-top:10px;">
                            <button
                                type="submit"
                                style="width:100%;padding:12px;background:#0b2f2a;color:white;border:none;border-radius:8px;font-size:16px;font-weight:600;"
                            >
                                <i class="bi bi-person-check-fill"></i> Create Farmer Account
                            </button>
                        </div>

                        <p style="text-align:center;margin-top:18px;margin-bottom:0;color:#777;">
                            Already have an account?

                            <a
                                href="{{ route('farmer.login') }}"
                                style="color:#0b2f2a;font-weight:600;text-decoration:none;"
                            >
                                Login
                            </a>
                        </p>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


@endsection