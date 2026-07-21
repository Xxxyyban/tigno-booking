<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation | TignoBooking</title>

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
            --success: #22c55e;
            --warning: #f59e0b;
            --glass: rgba(255, 255, 255, .08);
            --glass-border: rgba(255, 255, 255, .15);
            --text: #ffffff;
            --muted: #b8bfd1;
            --radius: 28px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #070b16;
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
            position: relative;
            padding: 100px 25px 70px 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* FIXED GLASS-MORPHISM NAVBAR */
        .custom-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(7, 11, 22, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 30px;
        }

        .custom-navbar .navbar-brand {
            font-weight: 800;
            font-size: 20px;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .custom-navbar .navbar-brand i {
            color: var(--primary);
        }

        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, .45), transparent 35%),
                radial-gradient(circle at 90% 20%, rgba(255, 56, 92, .40), transparent 35%),
                radial-gradient(circle at 50% 100%, rgba(34, 197, 94, .28), transparent 45%),
                radial-gradient(circle at 30% 70%, rgba(147, 51, 234, .30), transparent 35%);
            animation: aurora 18s linear infinite alternate;
            z-index: -3;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .03), transparent, rgba(255, 255, 255, .02));
            backdrop-filter: blur(40px);
            z-index: -2;
        }

        @keyframes aurora {
            0% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.2) rotate(8deg); }
            100% { transform: scale(1.1) rotate(-6deg); }
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .35;
            animation: floatBlob 12s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }
        .blob.one { width: 300px; height: 300px; background: #ff385c; left: -80px; top: 80px; }
        .blob.two { width: 260px; height: 260px; background: #3b82f6; right: -80px; top: 120px; animation-delay: 3s; }
        .blob.three { width: 240px; height: 240px; background: #22c55e; bottom: -60px; left: 40%; animation-delay: 5s; }

        @keyframes floatBlob {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-35px) scale(1.15); }
        }

        .booking-container {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 450px;
            gap: 35px;
            position: relative;
            z-index: 5;
        }

        .panel {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(25px);
            border-radius: var(--radius);
            box-shadow: 0 25px 60px rgba(0, 0, 0, .35), inset 0 1px rgba(255, 255, 255, .08);
            padding: 40px;
            transition: .35s ease;
        }
        .panel:hover {
            transform: translateY(-5px);
        }

        .title {
            font-size: 45px;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(90deg, #ffffff, #ff385c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .desc {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.6;
        }

        .badge-premium {
            padding: 10px 18px;
            border-radius: 30px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .15);
            font-size: 13px;
            color: white;
            display: inline-block;
        }

        .section-summary {
            background: rgba(0, 0, 0, .25);
            border-radius: 22px;
            padding: 24px;
            margin-top: 25px;
            border: 1px solid rgba(255, 255, 255, .08);
        }

        .section-summary h6 {
            color: var(--primary);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
            color: var(--muted);
            font-size: 15px;
        }
        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-row:first-of-type {
            padding-top: 0;
        }
        .info-row span {
            color: white;
            font-weight: 600;
        }

        .upload-card {
            background: rgba(255, 255, 255, .04);
            border-radius: 22px;
            padding: 30px 20px;
            border: 1px solid rgba(255, 255, 255, .08);
            text-align: center;
        }

        .upload-icon {
            width: 76px;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff385c, #e11d48);
            font-size: 32px;
            color: white;
            box-shadow: 0 10px 25px rgba(255, 56, 92, 0.3);
        }

        label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            display: block;
        }

        .form-control, textarea {
            background: rgba(7, 11, 22, 0.65) !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, .15) !important;
            border-radius: 18px !important;
            padding: 12px 20px;
            transition: .3s ease;
        }
        .form-control[type="file"] {
            padding: 10px 14px;
            height: auto;
        }
        textarea { height: auto !important; }
        .form-control::placeholder { color: rgba(255,255,255,0.35); }
        .form-control:focus, textarea:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(255, 56, 92, .25) !important;
        }

        .form-control::file-selector-button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 10px;
            font-weight: 600;
            margin-right: 15px;
            transition: 0.2s ease;
            cursor: pointer;
        }
        .form-control::file-selector-button:hover {
            background: var(--primary-dark);
        }

        .premium-btn {
            width: 100%;
            border: none;
            padding: 15px 20px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 700;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: .35s ease;
            color: white;
        }
        .premium-btn:hover {
            transform: translateY(-4px) scale(1.01);
        }
        .premium-btn.primary {
            background: linear-gradient(135deg, #ff385c, #e11d48);
            box-shadow: 0 15px 30px rgba(255, 56, 92, 0.3);
        }
        .premium-btn.primary:hover {
            box-shadow: 0 20px 40px rgba(255, 56, 92, 0.45);
        }

        .security-note {
            text-align: center;
            font-size: 12px;
            color: var(--muted);
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .security-note i {
            color: var(--success);
        }

        @media(max-width: 1000px) {
            body { padding: 85px 15px 35px 15px; }
            .booking-container { grid-template-columns: 1fr; gap: 25px; }
            .title { font-size: 35px; }
            .panel { padding: 25px!important; border-radius: 22px; }
        }
    </style>
</head>
<body>
    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid p-0 px-3">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-layers-half"></i> Tigno
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

    <div class="blob one"></div>
    <div class="blob two"></div>
    <div class="blob three"></div>

    <div class="booking-container">

        <!-- LEFT PANEL: REGISTRATION SUMMARY VERIFICATION -->
        <div class="panel">
            <span class="badge-premium">
                <i class="bi bi-shield-check me-1 text-primary"></i> Step 2 of 3 • Verification Block
            </span>

            <h1 class="title mt-4 mb-2">Review Your Registry</h1>
            <p class="desc">Please confirm your personal credentials alongside your operational reservation periods mapped below before settling calculations.</p>

            <!-- Account Validation Metrics -->
            <div class="section-summary">
                <h6><i class="bi bi-person-badge text-primary"></i>Identity Parameters</h6>
                <div class="info-row">
                    Client Name <span>{{ session('full_name') }}</span>
                </div>
                <div class="info-row">
                    Contact Node <span>{{ session('contact') }}</span>
                </div>
                <div class="info-row">
                    Electronic Mail <span>{{ session('email') }}</span>
                </div>
            </div>

            <!-- Accommodation Mapping Details -->
            <div class="section-summary">
                <h6><i class="bi bi-house-gear text-primary"></i>Structural Operations</h6>
                <div class="info-row">
                    Linked Target Event <span>{{ session('event_name') }}</span>
                </div>
                <div class="info-row">
                    Room Assignment <span>{{ session('room_type') }}</span>
                </div>
                <div class="info-row">
                    Allotted Visitors <span>{{ session('guests') }} {{ session('guests') == 1 ? 'Guest' : 'Guests' }}</span>
                </div>
            </div>

            <!-- Timeline Intervals -->
            <div class="section-summary">
                <h6><i class="bi bi-clock-history text-primary"></i>Allotted Timeline Range</h6>
                <div class="info-row">
                    Operational Initialization <span>{{ session('booking_datetime') }}</span>
                </div>
                <div class="info-row">
                    Termination Boundary <span>{{ session('end_datetime') }}</span>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL: DISPATCH PAYMENT MATRIX -->
        <div class="panel">
            <div class="upload-card">
                <div class="upload-icon">
                    <i class="bi bi-cloud-arrow-up"></i>
                </div>

                <h3 class="fw-bold mb-2">Upload Voucher</h3>
                <p class="text-muted small mb-4">Transmit your legal transaction receipt below to confirm architectural allocation settings.</p>

                <!-- FIXED FORM ACTION TARGET -->
                <form action="{{ route('booking.confirmation.store') }}" method="POST" enctype="multipart/form-data" class="text-start">
                    @csrf

                    <!-- Dynamic Error Parsing Blocks -->
                    @if ($errors->any())
                        <div class="alert alert-danger" style="background: rgba(255, 56, 92, 0.15); border: 1px solid var(--primary); color: white; border-radius: 15px; padding: 12px; margin-bottom: 20px;">
                            <ul class="mb-0 small" style="padding-left: 15px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="receipt">Receipt File Transaction</label>
                        <input type="file" name="receipt" id="receipt" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>

                    <div class="mb-4">
                        <label for="notes">Additional Pipeline Instructions</label>
                        <textarea name="notes" id="notes" rows="4" class="form-control" placeholder="Optional notes regarding adjustments, timing structural modifiers..."></textarea>
                    </div>

                    <button type="submit" class="premium-btn primary">
                        <i class="bi bi-shield-lock-fill"></i> Complete Verification
                    </button>
                </form>

                <div class="security-note">
                    <i class="bi bi-lock-fill"></i> Secure Cryptographic Verification System
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>