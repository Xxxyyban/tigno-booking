<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Account | Tigno Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#0f172a;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;
        }

        .bg-glow{
            position:absolute;
            width:600px;
            height:600px;
            background:#ff385c;
            border-radius:50%;
            filter:blur(120px);
            opacity:.15;
            top:-220px;
            left:-220px;
        }

        .bg-glow2{
            position:absolute;
            width:600px;
            height:600px;
            background:#3b82f6;
            border-radius:50%;
            filter:blur(120px);
            opacity:.15;
            bottom:-220px;
            right:-220px;
        }

        .register-card{

            width:950px;
            max-width:95%;

            display:grid;
            grid-template-columns:1.2fr 1fr;

            background:rgba(255,255,255,.05);
            backdrop-filter:blur(18px);

            border-radius:20px;
            overflow:hidden;

            border:1px solid rgba(255,255,255,.08);

            box-shadow:0 25px 60px rgba(0,0,0,.45);

            position:relative;
            z-index:10;

        }

        .left{

            padding:50px;
            color:white;

        }

        .right{

            padding:40px;
            background:rgba(255,255,255,.05);
            display:flex;
            align-items:center;

        }

        .badge-custom{

            display:inline-block;
            background:rgba(255,255,255,.08);

            padding:6px 14px;

            border-radius:30px;

            font-size:12px;

            margin-bottom:20px;

        }

        h1{

            font-size:40px;
            margin-bottom:25px;

        }

        .feature{

            margin:18px 0;
            color:#d1d5db;

        }

        .feature i{

            color:#22c55e;
            margin-right:10px;

        }

        .form-box{

            width:100%;

            background:rgba(255,255,255,.05);

            border:1px solid rgba(255,255,255,.08);

            border-radius:15px;

            padding:25px;

        }

        .form-box h3{

            color:white;

        }

        .form-box p{

            color:#94a3b8;
            margin-bottom:20px;

        }

        input{

            width:100%;
            padding:12px;

            margin-bottom:15px;

            background:#1e293b;

            border:none;

            border-radius:10px;

            color:white;

            outline:none;

        }

        input::placeholder{

            color:#94a3b8;

        }

        .btn-register{

            width:100%;

            padding:13px;

            border:none;

            border-radius:10px;

            background:#ff385c;

            color:white;

            font-weight:bold;

            transition:.3s;

        }

        .btn-register:hover{

            background:#e11d48;

        }

        .footer{

            text-align:center;

            margin-top:20px;

            color:#94a3b8;

            font-size:13px;

        }

        .footer a{

            color:#ff385c;
            text-decoration:none;

        }

        .error{

            color:#ef4444;
            font-size:13px;
            margin-bottom:10px;

        }

        @media(max-width:900px){

            .register-card{

                grid-template-columns:1fr;

            }

        }

    </style>

</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid p-0">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-layers-half me-1"></i> Tigno
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tignoNavbar" aria-controls="tignoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="tignoNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                </ul>
            </div>
        </div>
    </nav>
<div class="bg-glow"></div>
<div class="bg-glow2"></div>

<div class="register-card">

    <!-- LEFT -->

    <div class="left">

        <div class="badge-custom">
            CREATE ACCOUNT
        </div>

        <h1>Join Tigno Booking</h1>

        <div class="feature">
            <i class="bi bi-check-circle-fill"></i>
            Fast online reservations
        </div>

        <div class="feature">
            <i class="bi bi-check-circle-fill"></i>
            Secure booking information
        </div>

        <div class="feature">
            <i class="bi bi-check-circle-fill"></i>
            Real-time availability
        </div>

        <div class="feature">
            <i class="bi bi-check-circle-fill"></i>
            Easy booking management
        </div>

    </div>

    <!-- RIGHT -->

    <div class="right">

        <div class="form-box">

            <h3>Create Account</h3>

            <p>Complete the form below</p>

            <form method="POST" action="{{ route('register') }}">

                @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    value="{{ old('name') }}"
                    required>

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <input
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    value="{{ old('email') }}"
                    required>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required>

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required>

                <button class="btn-register">
                    Create Account
                </button>

            </form>

            <div class="footer">

                Already have an account?

                <br><br>

                <a href="{{ route('login') }}">
                    Login Here
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>