@extends('customer.master')

@section('main')

<link rel="stylesheet" href="{{ asset('customers/assets/css/register.css') }}">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="register-box shadow-sm p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('customers/Images/logo.png') }}" alt="MarketLink" class="logo mb-3">
                    <h2 class="fw-bold">Create Account</h2>
                    <p class="text-muted">
                        Register as a customer on MarketLink.
                    </p>
                </div>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="customer">


                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <b>Full Name</b>
                        </label>

                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your full name"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <b>Email</b>
                        </label>

                        <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <b>Phone Number</b>
                        </label>

                        <input class="form-control" id="phone" name="contact" type="tel"
                            placeholder="Enter phone number" value="{{ old('contact') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">
                            <b>Address</b>
                        </label>

                        <textarea class="form-control" id="address" name="address" rows="3"
                            placeholder="Enter your address" required>{{ old('address') }}</textarea>
                    </div>



                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <b>Password</b>
                        </label>

                        <input class="form-control" id="password" name="password" type="password"
                            placeholder="Create password" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">
                            <b>Confirm Password</b>
                        </label>

                        <input class="form-control" id="confirmPassword" name="password_confirmation" type="password"
                            placeholder="Confirm password" required>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" id="terms" name="terms" type="checkbox" value="1" required>

                            <label class="form-check-label" for="terms">
                                I agree to the terms and conditions.
                            </label>
                        </div>
                    </div>

                    <button class="btn btn-main w-100" type="submit">
                        Create Account
                    </button>
                </form>

                <p class="text-center mt-4 mb-0">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </div>

        </div>
    </div>
</div>

@endsection