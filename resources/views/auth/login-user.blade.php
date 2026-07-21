<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In | Tigno Booking Premium</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ff385c;
            --primary-hover: #e02849;
            --bg-dark: #060913;
            --card-bg: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(255, 255, 255, 0.04);
            --input-border: rgba(255, 255, 255, 0.07);
            --text-muted: #94a3b8;
            --radius-main: 24px;
            --radius-input: 14px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background: var(--bg-dark);
            min-height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Fluid Animated Aurora Background Layers */
        body::before, body::after {
            content: "";
            position: fixed;
            width: 50vw;
            height: 50vw;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.4;
            pointer-events: none;
            animation: auroraMotion 20s infinite alternate ease-in-out;
        }

        body::before {
            top: -10%;
            right: -10%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.6) 0%, transparent 70%);
        }

        body::after {
            bottom: -10%;
            left: -10%;
            background: radial-gradient(circle, rgba(255, 56, 92, 0.5) 0%, transparent 70%);
            animation-delay: -7s;
        }

        @keyframes auroraMotion {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-5%, 10%) scale(1.1); }
            100% { transform: translate(10%, -5%) scale(0.9); }
        }

        /* NAVIGATION BAR */
        .custom-navbar {
            width: 1060px;
            max-width: 100%;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
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
            letter-spacing: 2px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            text-transform: uppercase;
        }

        /* Glassmorphism Card Wrapper */
        .login-card {
            width: 1060px;
            max-width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            border-radius: var(--radius-main);
            overflow: hidden;
            background: var(--card-bg);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid var(--card-border);
            box-shadow: 0 40px 120px rgba(0, 0, 0, 0.6), inset 0 1px 1px rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 10;
            animation: cardEntrance 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(30px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Left Side Panel */
        .left {
            padding: 64px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-header i {
            color: var(--primary);
        }

        .hero-headline-wrapper {
            margin: 60px 0;
        }

        h1 {
            font-size: 48px;
            font-weight: 800;
            letter-spacing: -1.5px;
            line-height: 1.15;
            margin-bottom: 36px;
            background: linear-gradient(135deg, #ffffff 30%, #ff8ea1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
            color: #e2e8f0;
            font-size: 15px;
            line-height: 1.4;
        }

        .feature-item i {
            color: #10b981;
            font-size: 14px;
            background: rgba(16, 185, 129, 0.12);
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .feature-title {
            font-weight: 600;
            color: white;
            display: block;
            margin-bottom: 2px;
        }

        .feature-desc {
            color: var(--text-muted);
            font-size: 14px;
        }

        .left-footer {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* Right Side Form Engine */
        .right {
            padding: 64px;
            background: rgba(5, 8, 17, 0.45);
            border-left: 1px solid var(--card-border);
            display: flex;
            align-items: center;
        }

        .login-box {
            width: 100%;
        }

        .login-box h3 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white;
            margin-bottom: 8px;
        }

        .login-box p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 32px;
        }

        /* Form Inputs */
        .glass-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .glass-input-wrapper .field-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 18px;
            transition: color 0.25s ease;
            pointer-events: none;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 5;
        }

        .password-toggle:hover {
            color: white;
        }

        .form-control-glass {
            width: 100%;
            padding: 16px 16px 16px 52px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: var(--radius-input);
            color: white;
            font-size: 15px;
            outline: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-glass[name="password"] {
            padding-right: 52px;
        }

        .form-control-glass::placeholder {
            color: #475569;
        }

        .form-control-glass:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 56, 92, 0.5);
            box-shadow: 0 0 24px rgba(255, 56, 92, 0.15);
        }

        .form-control-glass:focus ~ .field-icon {
            color: var(--primary);
        }

        /* Action Buttons */
        .btn-login {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: var(--radius-input);
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 8px 24px rgba(255, 56, 92, 0.2);
            margin-top: 28px;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 32px rgba(255, 56, 92, 0.35);
            background: var(--primary-hover);
        }

        /* Micro-Badges Footer */
        .system-footer {
            margin-top: 36px;
            text-align: center;
            color: #334155;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 24px;
        }

        .system-footer span {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-weight: 500;
        }

        .system-footer i {
            font-size: 14px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .login-card { grid-template-columns: 1fr; max-width: 520px; }
            .left { padding: 40px 32px 24px 32px; }
            .right { border-left: none; border-top: 1px solid var(--card-border); padding: 32px; }
            .hero-headline-wrapper { margin: 32px 0; }
            h1 { font-size: 36px; margin-bottom: 24px; }
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

    <!-- LOGIN CARD CONTAINER -->
    <div class="login-card">

        <!-- LEFT SIDE: PREMIUM BRAND THEATER -->
        <div class="left">
            <div class="brand-header">
                <i class="bi bi-compass-fill"></i> Tigno Booking
            </div>

            <div class="hero-headline-wrapper">
                <h1>Experience<br>the exceptional</h1>

                <div class="feature-item">
                    <i class="bi bi-lightning-fill"></i>
                    <div>
                        <span class="feature-title">Instant Reservations</span>
                        <span class="feature-desc">Confirm luxury stays and premium listings in one click.</span>
                    </div>
                </div>

                <div class="feature-item">
                    <i class="bi bi-shield-check"></i>
                    <div>
                        <span class="feature-title">End-to-End Security</span>
                        <span class="feature-desc">Enterprise-grade data encryption covers every transactional layer.</span>
                    </div>
                </div>

                <div class="feature-item">
                    <i class="bi bi-sliders2"></i>
                    <div>
                        <span class="feature-title">Tailored Portfolios</span>
                        <span class="feature-desc">Access customizable configuration rules for administrative operations.</span>
                    </div>
                </div>
            </div>

            <div class="left-footer">
                &copy; 2026 Tigno Luxury Group. All rights reserved.
            </div>
        </div>

        <!-- RIGHT SIDE: PREMIUM LOGIN LAYER -->
        <div class="right">
            <div class="login-box">
                <h3>Welcome back</h3>
                <p>Please enter your credentials to manage your dashboard.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input Field -->
                    <div class="glass-input-wrapper">
                        <input
                            type="email"
                            name="email"
                            placeholder="name@company.com"
                            required
                            autofocus
                            class="form-control-glass"
                        >
                        <i class="bi bi-envelope field-icon"></i>
                    </div>

                    <!-- Password Input Field -->
                    <div class="glass-input-wrapper">
                        <input
                            type="password"
                            name="password"
                            id="passwordField"
                            placeholder="Password"
                            required
                            class="form-control-glass"
                        >
                        <i class="bi bi-lock field-icon"></i>
                        <!-- Toggle Visibility Icon -->
                        <i class="bi bi-eye-slash password-toggle" id="passwordToggle"></i>
                    </div>

                    <button type="submit" class="btn-login">
                        Sign In to Dashboard <i class="bi bi-arrow-right-short"></i>
                    </button>
                </form>

                <!-- Stripe / Apple Aesthetic Footer System Status -->
                <div class="system-footer">
                    <span><i class="bi bi-check-circle-fill text-success"></i> Secure Node</span>
                    <span><i class="bi bi-cpu text-secondary"></i> 0.8ms Latency</span>
                    <span><i class="bi bi-globe2 text-secondary"></i> Global API</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Vanilla JS Password Visibility Switcher Engine -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordField = document.getElementById('passwordField');
            const passwordToggle = document.getElementById('passwordToggle');

            passwordToggle.addEventListener('click', () => {
                const isPassword = passwordField.type === 'password';
                passwordField.type = isPassword ? 'text' : 'password';
                
                passwordToggle.classList.toggle('bi-eye-slash', !isPassword);
                passwordToggle.classList.toggle('bi-eye', isPassword);
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>