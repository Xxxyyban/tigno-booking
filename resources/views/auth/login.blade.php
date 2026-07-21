<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal | Tigno Booking</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ff385c;
            --primary-dark: #e11d48;
            --secondary: #3b82f6;
            --glass: rgba(255, 255, 255, .05);
            --glass-border: rgba(255, 255, 255, .12);
            --radius-outer: 30px;
            --text: #ffffff;
            --muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #070b16;
            min-height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px 20px 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Aurora Shifting Background */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, .35), transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 56, 92, .3), transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(147, 51, 234, .18), transparent 45%);
            animation: auroraBg 20s linear infinite alternate;
            z-index: -2;
        }

        @keyframes auroraBg {
            0% { transform: scale(1) translate(0px, 0px); }
            50% { transform: scale(1.1) translate(15px, -15px); }
            100% { transform: scale(1) translate(0px, 0px); }
        }

        /* NAVIGATION BAR */
        .custom-navbar {
            width: 900px;
            max-width: 100%;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            backdrop-filter: blur(25px);
            padding: 12px 28px;
            margin-bottom: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            z-index: 100;
        }

        .custom-navbar .navbar-brand {
            font-size: 16px;
            letter-spacing: 3px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            text-transform: uppercase;
        }

        /* LOGIN CARD CONTAINER */
        .card-login {
            width: 900px;
            max-width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(35px);
            border-radius: var(--radius-outer);
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, .1);
            z-index: 10;
            animation: containerReveal .6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes containerReveal {
            from { opacity: 0; transform: translateY(20px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .left-panel {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel {
            padding: 50px;
            background: rgba(0, 0, 0, 0.2);
            border-left: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
        }

        .portal-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #fbbf24;
            margin-bottom: 20px;
            width: fit-content;
        }

        h1 {
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #ffffff 30%, #ff8097 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .portal-subtext {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 12px 0;
            color: #e2e8f0;
            font-size: 14px;
        }

        .feature-item i {
            color: #22c55e;
            font-size: 16px;
        }

        .login-form {
            width: 100%;
        }

        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 6px;
            display: block;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 16px;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 16px;
        }

        .form-control-custom {
            width: 100%;
            padding: 13px 15px 13px 45px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.04);
            color: white;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 0 4px rgba(255, 56, 92, 0.15);
        }

        .form-control-custom::placeholder {
            color: #64748b;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(255, 56, 92, 0.3);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 56, 92, 0.45);
        }

        .error-msg {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .card-login {
                grid-template-columns: 1fr;
            }
            .right-panel {
                border-left: none;
                border-top: 1px solid var(--glass-border);
                padding: 40px 30px;
            }
            .left-panel {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVIGATION BAR -->
    <nav class="custom-navbar">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <i class="bi bi-layers-half me-1"></i> Tigno
        </a>
    </nav>

    <!-- LOGIN PANEL CARD -->
    <div class="card-login">

        <!-- LEFT SIDE: IDENTITY & FEATURES -->
        <div class="left-panel">
            <div class="portal-badge">
                <i class="bi bi-shield-lock-fill"></i> RESTRICTED ENTRY
            </div>

            <h1>Admin Portal</h1>
            <p class="portal-subtext">Secure administrative control hub for managing reservations, spatial allocations, and system infrastructure metrics.</p>

            <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i> Encrypted Session Protocols
            </div>
            <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i> Live Capacity Management
            </div>
            <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i> Real-time Dashboard Synchronization
            </div>
        </div>

        <!-- RIGHT SIDE: FORM LOGIN -->
        <div class="right-panel">
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="hidden" name="login_type" value="admin">

                    <div class="mb-3">
                        <label class="form-label-custom">Admin Email</label>
                        <div class="input-group-custom">
                            <i class="bi bi-envelope-fill"></i>
                            <input type="email" name="email" class="form-control-custom" placeholder="admin@tigno.com" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Password</label>
                        <div class="input-group-custom">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
                        </div>
                        @error('password')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        Authenticate Access <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>