<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Customer Account | TignoBooking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top left, #fb7185, transparent 35%), radial-gradient(circle at bottom right, #2563eb, transparent 35%), #020617;
            overflow-x: hidden;
            padding: 24px;
        }

        .glow {
            position: fixed;
            width: 500px;
            height: 500px;
            background: #fb7185;
            filter: blur(120px);
            opacity: .25;
            top: -200px;
            left: -200px;
            z-index: -1;
            pointer-events: none;
        }

        .glow2 {
            position: fixed;
            width: 500px;
            height: 500px;
            background: #3b82f6;
            filter: blur(120px);
            opacity: .25;
            bottom: -200px;
            right: -200px;
            z-index: -1;
            pointer-events: none;
        }

        /* NAVIGATION BAR */
        .custom-navbar {
            width: 900px;
            max-width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 12px 24px;
            margin-bottom: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            z-index: 100;
        }

        .custom-navbar .navbar-brand {
            font-size: 16px;
            letter-spacing: 1px;
            font-weight: 800;
            color: #fb7185;
            text-decoration: none;
            text-transform: uppercase;
        }

        .register-card {
            width: 900px;
            max-width: 100%;
            display: grid;
            grid-template-columns: 1fr 420px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .15);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 35px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0, 0, 0, .5);
            animation: show .6s ease;
            z-index: 10;
        }

        @keyframes show {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: none; }
        }

        .left { padding: 50px; color: white; display: flex; flex-direction: column; justify-content: center; }
        .logo { font-size: 15px; font-weight: 700; color: #fb7185; }
        
        .title {
            font-size: 42px;
            font-weight: 800;
            margin-top: 20px;
            background: linear-gradient(90deg, white, #fb7185);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle { color: #cbd5e1; line-height: 1.7; margin-top: 15px; }
        .features { margin-top: 40px; }
        .feature { display: flex; gap: 12px; margin-bottom: 18px; color: #e2e8f0; }
        .feature i { color: #22c55e; }
        
        .right { padding: 40px; background: rgba(255, 255, 255, .06); }
        .form-title { color: white; font-size: 25px; font-weight: 700; margin-bottom: 25px; }
        
        label { color: #cbd5e1; font-size: 13px; }
        .input-group-text { background: rgba(255, 255, 255, .08); border: none; color: #fb7185; }
        
        .form-control {
            height: 52px;
            background: rgba(2, 6, 23, .7) !important;
            border: 1px solid rgba(255, 255, 255, .15) !important;
            color: white !important;
            border-radius: 12px !important;
        }

        .form-control::placeholder { color: #94a3b8; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(251, 113, 133, .25) !important; border-color: #fb7185 !important; }
        
        .password-box { position: relative; }
        .password-toggle { position: absolute; right: 15px; top: 14px; color: #94a3b8; cursor: pointer; font-size: 18px; z-index: 5; }
        .password-toggle:hover { color: white; }
        
        .password-rules { font-size: 13px; color: #94a3b8; }
        .password-rules div { margin-bottom: 7px; }
        .password-rules i { margin-right: 8px; }
        
        .valid { color: #22c55e !important; }
        .invalid { color: #ef4444 !important; }
        
        .strength { height: 6px; background: #334155; border-radius: 10px; overflow: hidden; }
        .strength-bar { height: 100%; width: 0%; transition: .4s; background: #ef4444; }
        
        .btn-create {
            margin-top: 25px;
            width: 100%;
            height: 55px;
            border: none;
            border-radius: 15px;
            background: linear-gradient(135deg, #fb7185, #e11d48);
            color: white;
            font-weight: 700;
            font-size: 16px;
            transition: .3s;
            cursor: pointer;
        }

        .btn-create:hover { transform: translateY(-3px); box-shadow: 0 20px 40px rgba(225, 29, 72, .5); }
        .login { text-align: center; margin-top: 20px; color: #cbd5e1; }
        .login a { color: #fb7185; text-decoration: none; font-weight: 600; }

        @media(max-width: 900px) {
            .register-card { grid-template-columns: 1fr; width: 100%; }
            .left { display: none; }
            .custom-navbar { width: 100%; }
        }
    </style>
</head>
<body>

    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-layers-half me-1"></i> Tigno
            </a>
            
            <button class="navbar-toggler text-white border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#tignoNavbar" aria-controls="tignoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="tignoNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                </ul>
            </div>
        </div>
    </nav>

    <div class="glow"></div>
    <div class="glow2"></div>

    <div class="register-card">
        <div class="left">
            <div class="logo">
                <i class="bi bi-calendar-heart"></i> TignoBooking
            </div>
            <h1 class="title">Create your account</h1>
            <p class="subtitle">Join our premium booking platform and manage your reservations faster and easier.</p>
            
            <div class="features">
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Secure booking system</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Real-time availability</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Fast confirmation process</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Professional event management</div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="right">
            <div class="form-title">Create Account</div>

            <form method="POST" action="{{ route('customer.register.store') }}">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>First Name</label>
                        <div class="input-group mb-1">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First name" value="{{ old('first_name') }}" required>
                        </div>
                        @error('first_name')
                            <div class="text-danger small mb-3">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>Last Name</label>
                        <div class="input-group mb-1">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last name" value="{{ old('last_name') }}" required>
                        </div>
                        @error('last_name')
                            <div class="text-danger small mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <label class="mt-2">Email</label>
                <div class="input-group mb-1">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@email.com" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger small mb-3">{{ $message }}</div>
                @enderror

                <label class="mt-2">Password</label>
                <div class="password-box mb-2">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Create strong password" required>
                    <i onclick="togglePassword()" id="eye" class="bi bi-eye password-toggle"></i>
                </div>

                <!-- PASSWORD REQUIREMENTS -->
                <div class="password-rules mt-3">
                    <div id="length"><i class="bi bi-circle"></i> Minimum 8 characters</div>
                    <div id="upper"><i class="bi bi-circle"></i> At least 1 uppercase letter (A-Z)</div>
                    <div id="lower"><i class="bi bi-circle"></i> At least 1 lowercase letter (a-z)</div>
                    <div id="number"><i class="bi bi-circle"></i> At least 1 number (0-9)</div>
                    <div id="special"><i class="bi bi-circle"></i> At least 1 special character (@$!%*?&#)</div>
                </div>

                <div class="strength mt-3">
                    <div id="bar" class="strength-bar"></div>
                </div>
                @error('password')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror

                <label class="mt-3">Confirm Password</label>
                <div class="password-box">
                    <input type="password" id="confirm" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Confirm password" required>
                    <i onclick="toggleConfirm()" id="eye2" class="bi bi-eye password-toggle"></i>
                </div>

                <button type="submit" class="btn-create">
                    <i class="bi bi-person-plus"></i> Create Account
                </button>

                <div class="login">
                    Already have an account? <a href="{{ route('login.user') }}">Login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function togglePassword(){
            let pass = document.getElementById("password");
            let eye = document.getElementById("eye");
            if(pass.type === "password"){
                pass.type = "text";
                eye.className = "bi bi-eye-slash password-toggle";
            } else {
                pass.type = "password";
                eye.className = "bi bi-eye password-toggle";
            }
        }

        function toggleConfirm(){
            let pass = document.getElementById("confirm");
            let eye = document.getElementById("eye2");
            if(pass.type === "password"){
                pass.type = "text";
                eye.className = "bi bi-eye-slash password-toggle";
            } else {
                pass.type = "password";
                eye.className = "bi bi-eye password-toggle";
            }
        }

        document.getElementById("password").addEventListener("input", function(){
            let password = this.value;
            let rules = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[@$!%*?&#]/.test(password)
            };

            let strength = 0;

            Object.keys(rules).forEach(function(rule){
                let item = document.getElementById(rule);
                if(rules[rule]){
                    item.classList.add("valid");
                    item.classList.remove("invalid");
                    item.querySelector("i").className = "bi bi-check-circle-fill";
                    strength += 20;
                } else {
                    item.classList.remove("valid");
                    item.classList.add("invalid");
                    item.querySelector("i").className = "bi bi-circle";
                }
            });

            let bar = document.getElementById("bar");
            bar.style.width = strength + "%";

            if(strength <= 40){
                bar.style.background = "#ef4444";
            } else if(strength <= 80){
                bar.style.background = "#facc15";
            } else {
                bar.style.background = "#22c55e";
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>