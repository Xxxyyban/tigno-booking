<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TignoBooking Dashboard</title>

    <!-- Premium Typography & Frameworks -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Animate.css for Apple/iOS-like fluid entrances -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #ff385c;
            --brand-gradient: linear-gradient(135deg, #ff385c 0%, #7928ca 50%, #0070f3 100%);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-glow: rgba(255, 56, 92, 0.15);
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            margin: 0;
            background: #030712;
            color: #f3f4f6;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated iOS Aurora Ambient Backdrop */
        .aurora-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
            background: radial-gradient(circle at 0% 0%, #0c1020 0%, #030712 100%);
        }

        .aurora-orb {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.25;
            mix-blend-mode: screen;
            animation: drift 25s infinite alternate ease-in-out;
        }

        .orb-1 { background: #ff385c; top: -200px; right: -100px; animation-delay: 0s; }
        .orb-2 { background: #7928ca; bottom: -300px; left: -100px; animation-delay: -5s; }
        .orb-3 { background: #0070f3; top: 40%; left: 30%; width: 400px; height: 400px; opacity: 0.15; }

        @keyframes drift {
            0% { transform: translate(0px, 0px) rotate(0deg) scale(1); }
            100% { transform: translate(100px, 50px) rotate(180deg) scale(1.2); }
        }

        /* Glassmorphism Reusable Elements */
        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
        }

        .glass-panel:hover {
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        /* PREMIUM NAVBAR */
        .navbar-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 40px;
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(3, 7, 18, 0.4);
            border-bottom: 1px solid var(--glass-border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            background: linear-gradient(90deg, #fff 0%, #ff385c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* PROFILE DROPDOWN STRUCTURAL FIX */
        .profile {
            position: relative;
            cursor: pointer;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 14px;
            border-radius: 100px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
        }

        .profile-box:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .profile-name {
            text-align: right;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.2;
        }

        .profile-email {
            color: #9ca3af;
            font-size: 11px;
            font-weight: 400;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--brand-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: white;
            box-shadow: 0 0 15px rgba(255, 56, 92, 0.4);
        }

        .dropdown-menu-custom {
            position: absolute;
            right: 0;
            top: 55px;
            width: 250px;
            background: #0b0f19;
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 10px;
            display: none;
            z-index: 110;
            box-shadow: 0 30px 60px rgba(0,0,0,0.6);
            transform: translateY(10px);
            opacity: 0;
            transition: transform 0.2s, opacity 0.2s;
        }

        .dropdown-menu-custom.show {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 500;
        }

        .dropdown-item-custom:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            transform: translateX(4px);
        }

        .dropdown-item-custom i {
            font-size: 16px;
            color: #9ca3af;
        }

        .dropdown-item-custom:hover i {
            color: var(--brand-primary);
        }

        /* HERO PIPELINE BANNER */
        .hero {
            margin: 40px auto;
            max-width: 1300px;
            padding: 80px;
            border-radius: 32px;
            background: radial-gradient(circle at 100% 100%, rgba(121, 40, 202, 0.15) 0%, transparent 50%), 
                        radial-gradient(circle at 0% 0%, rgba(255, 56, 92, 0.1) 0%, transparent 40%),
                        rgba(255, 255, 255, 0.02);
            border: 1px solid var(--glass-border);
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.05);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        }

        .hero h1 {
            font-size: 52px;
            font-weight: 800;
            letter-spacing: -1.5px;
            line-height: 1.1;
            max-width: 700px;
            background: linear-gradient(135deg, #ffffff 0%, #9ca3af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 18px;
            color: #9ca3af;
            max-width: 520px;
            margin-top: 16px;
            font-weight: 400;
        }

        .hero-btn {
            margin-top: 32px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: white;
            color: #030712;
            padding: 16px 36px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            box-shadow: 0 10px 30px rgba(255,255,255,0.1);
        }

        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(255,255,255,0.2);
            background: #f9fafb;
            color: #030712;
        }

        /* SECTION TITLE */
        .section-title {
            max-width: 1300px;
            margin: 60px auto 20px auto;
            padding: 0 20px;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background: var(--glass-border);
        }

        /* FEATURES GRID */
        .grid {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .card-box {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 32px;
            position: relative;
            overflow: hidden;
        }

        .card-box::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 24px;
            padding: 1px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .card-box:hover {
            transform: translateY(-6px);
            background: rgba(255,255,255,0.06);
            border-color: rgba(255, 56, 92, 0.3);
            box-shadow: 0 20px 40px rgba(255, 56, 92, 0.05);
        }

        .icon {
            font-size: 32px;
            background: linear-gradient(135deg, #ff385c 0%, #ff8a9e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .card-title {
            margin-top: 24px;
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
        }

        .card-text {
            margin-top: 10px;
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.5;
        }

        /* DYNAMIC LUXURY RECEIPT AREA (Conditioned on active sessions) */
        .receipt-container {
            max-width: 550px;
            margin: 40px auto;
            position: relative;
        }

        .receipt-card {
            background: #0f1322;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 35px;
            position: relative;
            box-shadow: 0 30px 70px rgba(0,0,0,0.5);
        }

        /* Cutout Ticket Deco Effect */
        .receipt-card::before, .receipt-card::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #030712;
            border-radius: 50%;
            bottom: 110px;
        }
        .receipt-card::before { left: -11px; border-right: 1px solid rgba(255, 255, 255, 0.08); }
        .receipt-card::after { right: -11px; border-left: 1px solid rgba(255, 255, 255, 0.08); }

        .receipt-dashed-line {
            border-top: 2px dashed rgba(255, 255, 255, 0.1);
            margin: 30px 0;
            position: relative;
        }

        .success-checkmark {
            width: 56px;
            height: 56px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 16px auto;
        }

        /* STRIPE STYLE KEY-VALUE ROW */
        .meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-size: 14px;
        }
        .meta-label { color: #9ca3af; }
        .meta-value { font-weight: 600; color: #ffffff; }

        .badge-premium {
            background: rgba(255, 56, 92, 0.1);
            border: 1px solid rgba(255, 56, 92, 0.2);
            color: #ff385c;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ACTIONABLE LOWER CTA BUTTON BANNER */
        .booking-banner {
            max-width: 1300px;
            margin: 60px auto 40px auto;
            padding: 60px;
            text-align: center;
            border-radius: 32px;
            background: linear-gradient(180deg, rgba(255,255,255,0.02) 0%, transparent 100%);
            border: 1px solid var(--glass-border);
            position: relative;
        }

        .booking-banner h2 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .booking-banner p {
            color: #9ca3af;
            font-size: 16px;
            margin-top: 8px;
        }

        .booking-banner a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            background: var(--brand-primary);
            padding: 14px 36px;
            border-radius: 14px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(255, 56, 92, 0.3);
        }

        .booking-banner a:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 56, 92, 0.5);
            background: #ff4f70;
        }

        .footer {
            text-align: center;
            padding: 40px 20px;
            color: #4b5563;
            font-size: 13px;
            border-top: 1px solid var(--glass-border);
            max-width: 1300px;
            margin: 0 auto;
        }

        /* CUSTOM TIMELINE COMPONENT */
        .premium-timeline {
            margin-top: 20px;
            padding-left: 20px;
            border-left: 2px solid rgba(255,255,255,0.05);
            position: relative;
        }
        .timeline-node {
            position: relative;
            padding-bottom: 20px;
        }
        .timeline-node::before {
            content: '';
            position: absolute;
            left: -26px;
            top: 4px;
            width: 10px;
            height: 10px;
            background: var(--brand-primary);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--brand-primary);
        }
        .timeline-node.node-end::before {
            background: #0070f3;
            box-shadow: 0 0 10px #0070f3;
        }

        /* RESPONSIVE MEDIA BREAKPOINTS */
        @media(max-width: 768px){
            .navbar-custom { padding: 16px 20px; }
            .hero { margin: 20px; padding: 40px 24px; }
            .hero h1 { font-size: 34px; }
            .booking-banner { margin: 20px; padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <!-- iOS Aurora Layer -->
    <div class="aurora-bg">
        <div class="aurora-orb orb-1"></div>
        <div class="aurora-orb orb-2"></div>
        <div class="aurora-orb orb-3"></div>
    </div>

    <!-- PREMIUM NAVBAR -->
    <div class="navbar-custom">
        <div class="logo">
            <i class="bi bi-fringe" style="color: var(--brand-primary)"></i> TignoBooking
        </div>

        <div class="profile" onclick="toggleMenu(event)">
            <div class="profile-box">
                <div class="profile-name">
                    <b>{{ Auth::user()->name }}</b>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>

            <!-- Fix: Dropdown properly encapsulated safely inside profile container context -->
            <div class="dropdown-menu-custom" id="accountMenu">
                <a href="#" class="dropdown-item-custom">
                    <i class="bi bi-person-bounding-box"></i> My Profile
                </a>
                <a href="#" class="dropdown-item-custom">
                    <i class="bi bi-collection-play"></i> My Bookings
                </a>
                <div style="border-top: 1px solid var(--glass-border); margin: 6px 0;"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item-custom border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right-left"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT HERO -->
    <div class="hero animate__animated animate__fadeInUp">
        <h1>Your perfect stay is just one click away.</h1>
        <p>Discover high-end comfortable rooms tailored for you, and lock in your next luxury stay instantly with TignoBooking.</p>
        <a href="{{ route('booking.details') }}" class="hero-btn">
            <i class="bi bi-plus-circle-fill"></i> Start New Booking
        </a>
    </div>

    <!-- DYNAMIC LIVE RECEIPT PIPELINE LAYOUT -->
    <!-- Displays a sleek verification module whenever a reservation is stored inside active layout sessions -->
    @if(session('booking_id') || session('success') || isset($activeBooking))
    <div class="section-title animate__animated animate__fadeInUp animate__delay-1s">
        <i class="bi bi-receipt-cutoff text-danger"></i> Active Premium Receipt
    </div>
    <div class="receipt-container animate__animated animate__fadeInUp animate__delay-1s">
        <div class="receipt-card">
            <div class="success-checkmark animate__animated animate__zoomIn animate__delay-2s">
                <i class="bi bi-shield-check"></i>
            </div>
            <h4 class="text-center font-bold mb-1" style="font-family:'Space Grotesk',sans-serif;">Reservation Verified</h4>
            <p class="text-center text-muted small mb-4">Thank you for your trust, {{ Auth::user()->name }}</p>

            <div class="meta-row">
                <span class="meta-label">Booking Reference ID</span>
                <span class="meta-value d-flex align-items-center gap-2">
                    <code id="bookingId" style="color:var(--brand-primary)">{{ session('booking_id') ?? 'TB-2026-9841' }}</code>
                    <i class="bi bi-copy text-muted cursor-pointer" onclick="copyBookingId()" style="cursor:pointer"></i>
                </span>
            </div>

            <div class="meta-row">
                <span class="meta-label">Tier Account Status</span>
                <span class="badge-premium"><i class="bi bi-gem me-1"></i> VIP Guest</span>
            </div>

            <div class="receipt-dashed-line"></div>

            <div class="premium-timeline">
                <div class="timeline-node">
                    <div class="fw-bold text-white small">Check-in Registration Schedule</div>
                    <div class="text-muted extra-small" style="font-size: 13px;">{{ session('booking_datetime') ?? 'Select Date & Time via Reservation Pipeline' }}</div>
                </div>
                <div class="timeline-node node-end style-none mb-0 pb-0">
                    <div class="fw-bold text-white small">Check-out Verification Wrap</div>
                    <div class="text-muted extra-small" style="font-size: 13px;">{{ session('end_datetime') ?? 'Dynamic Auto Checkout Protection Active' }}</div>
                </div>
            </div>

            <div class="receipt-dashed-line"></div>

            <!-- Interactivity Pipeline Utilities -->
            <div class="row g-2 mt-2">
                <div class="col-6">
                    <button class="btn btn-outline-light w-100 py-2.5 rounded-3 border-secondary style-none btn-sm" onclick="window.print()" style="border-radius:12px; font-size:13px; font-weight:600;">
                        <i class="bi bi-printer me-1"></i> Print Receipt
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-light w-100 py-2.5 rounded-3 btn-sm" onclick="alert('Downloading high fidelity reservation copy...')" style="border-radius:12px; font-size:13px; font-weight:700;">
                        <i class="bi bi-download me-1"></i> Download File
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- FEATURES OVERVIEW -->
    <div class="section-title animate__animated animate__fadeInUp">
        Why choose TignoBooking?
    </div>

    <div class="grid animate__animated animate__fadeInUp">
        <div class="card-box">
            <i class="bi bi-house-heart icon"></i>
            <div class="card-title">Comfortable Rooms</div>
            <div class="card-text">Explore spaces thoroughly curated and inspected for premium modern accommodations.</div>
        </div>

        <div class="card-box">
            <i class="bi bi-lightning-charge icon"></i>
            <div class="card-title">Fast Reservation</div>
            <div class="card-text">Breeze through workflows. Complete scheduling routes in less than 60 seconds flat.</div>
        </div>

        <div class="card-box">
            <i class="bi bi-shield-check icon"></i>
            <div class="card-title">Secure Booking</div>
            <div class="card-text">End-to-end data encryption loops protect your payment tokens and identity protocols.</div>
        </div>

        <div class="card-box">
            <i class="bi bi-headset icon"></i>
            <div class="card-title">Customer Support</div>
            <div class="card-text">Enjoy reliable client support directly inside the dashboard app whenever questions emerge.</div>
        </div>
    </div>

    <!-- LOWER CONTEXT ACTION BANNER -->
    <div class="booking-banner animate__animated animate__fadeInUp">
        <h2>Ready for your next experience?</h2>
        <p>Unlock architectural gems and cozy rooms instantly.</p>
        <a href="{{ route('booking.details') }}">
            Book Now <i class="bi bi-arrow-right-short font-bold"></i>
        </a>
    </div>

    <!-- PREMIUM FOOTER MAP -->
    <div class="footer">
        TignoBooking • Premium Global Reservation Ecosystem. All Rights Reserved.
    </div>

    <!-- BUSINESS INTELLIGENCE INTERACTIVE UTILITIES -->
    <script>
        // Dropdown Menu Controller with Synthetic Context Bubbling Interception
        function toggleMenu(event){
            event.stopPropagation();
            const menu = document.getElementById("accountMenu");
            menu.classList.toggle("show");
        }

        // Global Document click intercepts to safely lock active menus out
        window.onclick = function(event){
            if(!event.target.closest('.profile')){
                const dropdown = document.getElementById("accountMenu");
                if(dropdown.classList.contains('show')){
                    dropdown.classList.remove("show");
                }
            }
        }

        // Clipboard Copy Helper Engine for Booking Identifiers
        function copyBookingId() {
            const bookingText = document.getElementById("bookingId").innerText;
            navigator.clipboard.writeText(bookingText).then(() => {
                alert("Booking Reference ID successfully copied to clipboard!");
            }).catch(err => {
                console.error('Could not copy string text: ', err);
            });
        }
    </script>
</body>
</html>