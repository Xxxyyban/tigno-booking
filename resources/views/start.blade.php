<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tigno | Experience Premium Spaces</title>

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
            --primary-dark: #e61e4d;
            --secondary: #3b82f6;
            --glass: rgba(255, 255, 255, .08);
            --glass-border: rgba(255, 255, 255, .15);
            --radius-outer: 40px;
            --radius-inner: 25px;
            --text: #ffffff;
            --muted: #cbd5e1;
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
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
        }

        /* Ambient Aurora Background Shifting */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 15%, rgba(59, 130, 246, .4), transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(255, 56, 92, .35), transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(147, 51, 234, .2), transparent 45%);
            animation: auroraBg 20s linear infinite alternate;
            z-index: -2;
        }

        @keyframes auroraBg {
            0% { transform: scale(1) translate(0px, 0px); }
            50% { transform: scale(1.15) translate(20px, -20px); }
            100% { transform: scale(1) translate(0px, 0px); }
        }

        .main-container {
            width: 1320px;
            max-width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-outer);
            backdrop-filter: blur(35px);
            box-shadow: 0 50px 120px rgba(0, 0, 0, .6), inset 0 1px 0 rgba(255, 255, 255, .1);
            overflow: hidden;
            position: relative;
            z-index: 10;
            animation: containerReveal .7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes containerReveal {
            from { opacity: 0; transform: translateY(30px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* LEFT SIDE - IMMERSIVE MEDIA & BRAND THEATER */
        .theater-side {
            padding: 60px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 680px;
            overflow: hidden;
        }

        /* Auto-cycling background slideshow layer */
        .showcase-slider {
            position: absolute;
            inset: 0;
            z-index: -1;
        }

        .slide-item {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transform: scale(1.08);
            transition: opacity 1.5s ease-in-out, transform 1.5s ease-in-out;
        }

        .slide-item.active {
            opacity: 0.35; /* Keeps content strictly readable while showcasing the space */
            transform: scale(1);
        }

        .showcase-slider::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(7, 11, 22, 0.4) 0%, rgba(7, 11, 22, 0.85) 100%);
        }

        .brand-logo {
            font-size: 13px;
            letter-spacing: 3px;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-top: 30px;
            background: linear-gradient(135deg, #ffffff 30%, #ff8097 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            color: var(--muted);
            font-size: 17px;
            max-width: 520px;
            line-height: 1.6;
            margin-top: 20px;
        }

        .feature-grid {
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .feature-tag {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 12px 18px;
            border-radius: 16px;
            font-size: 14px;
            color: #e2e8f0;
        }

        .feature-tag i {
            color: #22c55e;
            font-size: 18px;
        }

        .stats-strip {
            display: flex;
            gap: 20px;
            margin-top: 50px;
        }

        .stat-block {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.06);
            padding: 14px 24px;
            border-radius: 18px;
            min-width: 120px;
            text-align: center;
        }

        .stat-block h4 {
            margin: 0;
            font-weight: 800;
            font-size: 22px;
            color: white;
        }

        .stat-block p {
            font-size: 11px;
            color: #94a3b8;
            margin: 5px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* RIGHT SIDE - GATEWAY ONBOARDING MATRIX */
        .gateway-side {
            background: rgba(7, 11, 22, 0.45);
            border-left: 1px solid var(--glass-border);
            padding: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .onboarding-card {
            width: 100%;
            max-width: 420px;
            background: rgba(0, 0, 0, 0.25);
            border-radius: var(--radius-inner);
            padding: 40px 35px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        .portal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px auto;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff385c, #e11d48);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            color: white;
            box-shadow: 0 12px 30px rgba(255, 56, 92, 0.35);
        }

        .portal-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .portal-desc {
            color: #94a3b8;
            font-size: 14px;
            margin-top: 8px;
            line-height: 1.5;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 16px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            transition: .3s cubic-bezier(0.25, 0.8, 0.25, 1);
            cursor: pointer;
        }

        .action-btn.btn-filled {
            background: linear-gradient(135deg, #ff385c, #e11d48);
            color: white;
            border: none;
            box-shadow: 0 12px 24px rgba(255, 56, 92, 0.25);
            margin-top: 35px;
        }

        .action-btn.btn-filled:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 35px rgba(255, 56, 92, 0.45);
            color: white;
        }

        .action-btn.btn-framed {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            margin-top: 15px;
        }

        .action-btn.btn-framed:hover {
            background: white;
            color: #070b16;
            border-color: white;
            transform: translateY(-3px);
        }

        .security-badge {
            margin-top: 30px;
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .security-badge i {
            color: #22c55e;
        }

        /* RESPONSIVE LAYOUT MATRIX */
        @media (max-width: 1024px) {
            .main-container { grid-template-columns: 1fr; }
            .gateway-side { border-left: none; border-top: 1px solid var(--glass-border); padding: 50px 30px; }
            .theater-side { padding: 40px 30px; min-height: auto; }
            .hero-title { font-size: 40px; }
            .feature-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="main-container">

        <!-- LEFT COLUMN: CAPTIVATING IMAGE SLIDESHOW & BRAND CORE -->
        <div class="theater-side">
            <!-- Dynamic Background Slide Frame Layer -->
            <div class="showcase-slider">
                <!-- Using beautiful architectural & lifestyle environments to frame user imagination -->
                <div class="slide-item active" style="background-image: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&q=80&w=1200');"></div>
                <div class="slide-item" style="background-image: url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&q=80&w=1200');"></div>
                <div class="slide-item" style="background-image: url('https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&q=80&w=1200');"></div>
            </div>

            <!-- Header Identity -->
            <div class="brand-logo">
                <i class="bi bi-layers-half me-1"></i> Tigno
            </div>

            <!-- Mid Content Branding Statements -->
            <div>
                <h1 class="hero-title">
                    Your Event.<br>
                    Your Schedule.<br>
                    Your Experience.
                </h1>
                <p class="hero-desc">
                    Welcome to a modern reservation pipeline engineered for lightning fast allocation setups, real-time tracking metrics, and pristine architectural layouts.
                </p>

                <!-- Value Proposition Tags -->
                <div class="feature-grid">
                    <div class="feature-tag">
                        <i class="bi bi-shield-check-fill"></i> Instant Infrastructure Setup
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-calendar-range-fill"></i> Dynamic Live Calendars
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-fingerprint"></i> Encrypted Asset Verification
                    </div>
                    <div class="feature-tag">
                        <i class="bi bi-sliders2"></i> Granular Administrative Toggles
                    </div>
                </div>
            </div>

            <!-- Base Analytical Trackers -->
            <div class="stats-strip">
                <div class="stat-block">
                    <h4>24/7</h4>
                    <p>Live Nodes</p>
                </div>
                <div class="stat-block">
                    <h4>100%</h4>
                    <p>Secured</p>
                </div>
                <div class="stat-block">
                    <h4>&lt; 3m</h4>
                    <p>Processing</p>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: INTERACTIVE GATEWAY MATRIX -->
        <div class="gateway-side">
            <div class="onboarding-card">
                <div class="portal-icon">
                    <i class="bi bi-calendar3-event"></i>
                </div>

                <h2 class="portal-title">Start Booking</h2>
                <p class="portal-desc">Initialize credentials or access your structural dashboard nodes to allocate space environments.</p>

                <!-- Routing Anchors matching customer execution points -->
                <a href="{{ route('customer.register') }}" class="action-btn btn-filled">
                    <i class="bi bi-person-plus-fill"></i> Establish Matrix Account
                </a>

                <a href="{{ route('login.user') }}" class="action-btn btn-framed">
                    <i class="bi bi-box-arrow-in-right"></i> System Authorization Login
                </a>

                <!-- Security Verification Footer -->
                <div class="security-badge">
                    <i class="bi bi-shield-lock-fill"></i> Standardized Security Protocol Operational
                </div>
            </div>
        </div>

    </div>

    <!-- Background Slider Initialization Routine Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.slide-item');
            let activeIndex = 0;

            setInterval(() => {
                slides[activeIndex].classList.remove('active');
                activeIndex = (activeIndex + 1) % slides.length;
                slides[activeIndex].classList.add('active');
            }, 5000); // Cycles premium locations fluidly every 5 seconds
        });
    </script>
</body>
</html>