<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - MarketLink</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .logincontainer {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            background: #ffffff;
            padding: 40px;
            border-radius: 14px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 6px;
        }

        .logo h1 span {
            color: #4caf50;
        }

        .logo p {
            font-size: 14px;
            color: #888;
        }

        .login-box h2 {
            text-align: center;
            font-size: 25px;
            color: #333;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #444;
        }

        .input-group input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid #d9d9d9;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
            background: #fff;
        }

        .input-group input:focus {
            border-color: #4caf50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.10);
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .login-options label {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #666;
            cursor: pointer;
        }

        .login-options input[type="checkbox"] {
            width: 15px;
            height: 15px;
        }

        .login-options a {
            color: #4caf50;
            text-decoration: none;
        }

        .login-options a:hover {
            text-decoration: underline;
        }

        .success-message {
            color: #15803d;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 11px 12px;
            border-radius: 7px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .error-message {
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
            padding: 11px 12px;
            border-radius: 7px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .login-button {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 7px;
            background: #4caf50;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .login-button:hover {
            background: #43a047;
        }

        @media (max-width: 500px) {
            .logincontainer {
                padding: 15px;
            }

            .login-box {
                padding: 30px 22px;
            }

            .logo h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div class="logincontainer">

    <div class="login-box">

        <div class="logo">
            <h1>Market<span>Link</span></h1>
            <p>Admin Panel</p>
        </div>

        <h2>Welcome Back</h2>

        <p class="subtitle">
            Login to access your admin dashboard
        </p>


        {{-- Success Message --}}
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif


        {{-- Error Message --}}
        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif


        <form
            action="{{ route('admin.login.store') }}"
            method="POST"
        >

            @csrf


            {{-- Email --}}
            <div class="input-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >

            </div>


            {{-- Password --}}
            <div class="input-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            {{-- Options --}}
            <div class="login-options">

                <label>
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Remember me
                </label>

                <a href="#">
                    Forgot Password?
                </a>

            </div>


            {{-- Login --}}
            <button
                type="submit"
                class="login-button"
            >
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>