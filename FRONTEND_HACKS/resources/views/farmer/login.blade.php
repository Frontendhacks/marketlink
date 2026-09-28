@extends('farmer.master')
@section('title', 'FarmHub Farmer Login')
@section('bare', '1')
@section('main')



<div style="
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:30px;
    background-image:url('{{ asset('farmers/images/login bg.jpg') }}');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    margin:-30px;
">

    <div style="
        width:600px;
        max-width:100%;
        background:white;
        border-radius:16px;
        overflow:hidden;
        display:flex;
        box-shadow:0 8px 30px rgba(0,0,0,0.10);
    ">

        <div style="
            width:45%;
            background:#073f35;
            color:white;
            padding:45px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        ">

            <div style="font-size:27px;font-weight:bold;margin-bottom:35px;">
                <i class="bi bi-leaf-fill" style="color:#55c96a;"></i>
                Farm<span style="color:#55c96a;">Hub</span>
            </div>

            <h2 style="font-size:30px;font-weight:700;margin-bottom:15px;">
                Farmer Login
            </h2>

            <p style="color:#c5dcd6;font-size:14px;line-height:1.7;margin-bottom:28px;">
                Login to manage your farm products, orders and sales from your FarmHub account.
            </p>

            <div style="display:flex;align-items:center;margin-bottom:15px;">
                <i class="bi bi-box-seam"
                    style="color:#63d477;font-size:20px;margin-right:12px;"></i>
                <span style="font-size:14px;">Manage your products</span>
            </div>

            <div style="display:flex;align-items:center;margin-bottom:15px;">
                <i class="bi bi-cart-check"
                    style="color:#63d477;font-size:20px;margin-right:12px;"></i>
                <span style="font-size:14px;">Manage customer orders</span>
            </div>

            <div style="display:flex;align-items:center;">
                <i class="bi bi-graph-up-arrow"
                    style="color:#63d477;font-size:20px;margin-right:12px;"></i>
                <span style="font-size:14px;">Track your farm sales</span>
            </div>

        </div>

        <div style="width:55%;padding:45px;">

            <form action="{{ route('farmer.login.store') }}" method="POST">
                @csrf

                <input type="hidden" name="role" value="farmer">

                <div style="margin-bottom:25px;">
                    <h2 style="
                        margin:0 0 7px;
                        color:#173f39;
                        font-size:27px;
                        font-weight:700;
                    ">
                        Welcome Farmer!
                    </h2>

                    <p style="
                        margin:0;
                        color:#7d8986;
                        font-size:14px;
                    ">
                        Login to your farmer account
                    </p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div style="margin-bottom:18px;">

                    <label style="
                        display:block;
                        font-size:14px;
                        font-weight:600;
                        color:#344b47;
                        margin-bottom:7px;
                    ">
                        Farmer Email
                    </label>

                    <div style="position:relative;">

                        <i class="bi bi-envelope"
                            style="
                                position:absolute;
                                left:14px;
                                top:12px;
                                color:#7b918b;
                            ">
                        </i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your farmer email"
                            value="{{ old('email') }}"
                            style="
                                width:100%;
                                height:45px;
                                box-sizing:border-box;
                                border:1px solid #d8e3df;
                                border-radius:8px;
                                padding-left:42px;
                                padding-right:12px;
                                outline:none;
                                background:#fbfdfc;
                                font-size:14px;
                            "
                            required
                        >

                    </div>
                </div>

                <div style="margin-bottom:10px;">

                    <label style="
                        display:block;
                        font-size:14px;
                        font-weight:600;
                        color:#344b47;
                        margin-bottom:7px;
                    ">
                        Password
                    </label>

                    <div style="position:relative;">

                        <i class="bi bi-lock"
                            style="
                                position:absolute;
                                left:14px;
                                top:12px;
                                color:#7b918b;
                            ">
                        </i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            style="
                                width:100%;
                                height:45px;
                                box-sizing:border-box;
                                border:1px solid #d8e3df;
                                border-radius:8px;
                                padding-left:42px;
                                padding-right:40px;
                                outline:none;
                                background:#fbfdfc;
                                font-size:14px;
                            "
                            required
                        >

                        <i
                            class="bi bi-eye"
                            id="togglePassword"
                            onclick="togglePass()"
                            style="
                                position:absolute;
                                right:14px;
                                top:12px;
                                color:#7b918b;
                                cursor:pointer;
                            ">
                        </i>

                    </div>
                </div>

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin:14px 0 23px;
                ">

                    <label style="color:#667572;font-size:13px;">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >
                        Remember me
                    </label>

                    <a href="#"
                        style="
                            color:#078b58;
                            text-decoration:none;
                            font-size:13px;
                            font-weight:600;
                        ">
                        Forgot Password?
                    </a>

                </div>

                <button
                    type="submit"
                    style="
                        width:100%;
                        height:46px;
                        border:none;
                        border-radius:8px;
                        background:#078b58;
                        color:white;
                        font-size:15px;
                        font-weight:600;
                        cursor:pointer;
                    "
                >
                    <i class="bi bi-box-arrow-in-right"
                        style="margin-right:7px;">
                    </i>
                    Login as Farmer
                </button>

                <div style="
                    text-align:center;
                    margin-top:22px;
                    color:#7d8986;
                    font-size:13px;
                ">

                    Don't have a farmer account?

                    <a
                        href="{{ route('farmer.register') }}"
                        style="
                            color:#078b58;
                            font-weight:600;
                            text-decoration:none;
                            margin-left:4px;
                        "
                    >
                        Register as Farmer
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
function togglePass() {

    let passInput = document.getElementById("password");
    let passIcon = document.getElementById("togglePassword");

    if (passInput.type === "password") {

        passInput.type = "text";

        passIcon.classList.remove("bi-eye");
        passIcon.classList.add("bi-eye-slash");

    } else {

        passInput.type = "password";

        passIcon.classList.remove("bi-eye-slash");
        passIcon.classList.add("bi-eye");

    }
}
</script>



@endsection