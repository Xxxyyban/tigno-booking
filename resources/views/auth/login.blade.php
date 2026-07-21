<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login | Tigno Booking</title>

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

        .card-login{
            width:900px;
            max-width:95%;
            display:grid;
            grid-template-columns:1.2fr 1fr;
            background:rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.08);
            backdrop-filter:blur(20px);
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 25px 80px rgba(0,0,0,.5);
        }

        .left{
            padding:50px;
            color:white;
        }

        .right{
            padding:40px;
            background:rgba(255,255,255,.04);
            display:flex;
            align-items:center;
        }

        .badge{
            display:inline-block;
            padding:6px 14px;
            background:rgba(255,255,255,.08);
            border-radius:30px;
            font-size:12px;
            margin-bottom:20px;
        }

        h1{
            font-size:42px;
            margin-bottom:20px;
        }

        .feature{
            margin:15px 0;
            color:#d1d5db;
        }

        .feature i{
            color:#22c55e;
            margin-right:8px;
        }

        .login-box{
            width:100%;
        }

        input{
            width:100%;
            margin-bottom:12px;
            padding:13px;
            border:none;
            border-radius:10px;
            background:#1e293b;
            color:white;
            outline:none;
        }

        input::placeholder{
            color:#94a3b8;
        }

        .btn-login{
            width:100%;
            padding:13px;
            border:none;
            border-radius:10px;
            background:#ff385c;
            color:white;
            font-weight:bold;
        }

        .btn-login:hover{
            background:#e11d48;
        }

        .admin-tag{
            color:#fbbf24;
            font-size:12px;
            margin-bottom:10px;
        }

        .error{
            color:#ef4444;
            font-size:13px;
            margin-bottom:10px;
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

<div class="card-login">

    <!-- LEFT -->
    <div class="left">

        <div class="badge">
            ADMIN PORTAL
        </div>

        <h1>Welcome Admin</h1>

        <div class="feature"><i class="bi bi-shield-check"></i> Secure System Access</div>
        <div class="feature"><i class="bi bi-gear"></i> Manage Bookings</div>
        <div class="feature"><i class="bi bi-graph-up"></i> Control Dashboard</div>
        <div class="feature"><i class="bi bi-lock"></i> Restricted Access Only</div>

    </div>

    <!-- RIGHT -->
    <div class="right">

        <div class="login-box">

            <div class="admin-tag">
                ADMIN LOGIN ONLY
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" name="login_type" value="admin">

                <input type="email" name="email" placeholder="Admin Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login as Admin</button>
            </form>

        </div>

    </div>

</div>

</body>
</html>