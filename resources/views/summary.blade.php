<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Summary | Tigno </title>

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

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #070b16;
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Aurora Background */
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

        /* Floating Blobs */
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

        /* UI Containers & Glassmorphism */
        .page {
            max-width: 1450px;
            margin: auto;
            padding: 70px 25px;
            position: relative;
            z-index: 5;
        }

        .glass {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(25px);
            border-radius: var(--radius);
            box-shadow: 0 25px 60px rgba(0, 0, 0, .35), inset 0 1px rgba(255, 255, 255, .08);
        }

        .fadeUp {
            opacity: 0;
            animation: fadeUp .9s ease forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(45px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Success Ring & Confetti */
        .success-circle { animation: pulse 2s infinite; }
        .progress-ring { stroke-dasharray: 330; stroke-dashoffset: 330; animation: ring 1.5s ease forwards; }
        .checkmark { stroke-dasharray: 100; stroke-dashoffset: 100; animation: check 1s ease .8s forwards; }

        @keyframes ring { to { stroke-dashoffset: 0; } }
        @keyframes check { to { stroke-dashoffset: 0; } }
        @keyframes pulse { 50% { transform: scale(1.08); } }

        /* Component Cards */
        .avatar {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 800;
            background: linear-gradient(135deg, #ff385c, #3b82f6);
            box-shadow: 0 15px 35px rgba(0, 0, 0, .35);
        }

        .info-card, .room-card, .timeline-card, .receipt, .notes-card, .confirmation, .footer, .sidebar {
            transition: .35s ease;
        }

        .info-card:hover, .room-card:hover, .timeline-card:hover, .receipt:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, .45);
        }

        .notes-card:hover, .confirmation:hover, .sidebar:hover {
            transform: translateY(-5px);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            font-size: 14px;
        }

        .detail-row span { color: #b8bfd1; }
        .detail-row i { margin-right: 8px; }

        .copy-btn {
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            color: white;
            transition: .3s;
        }

        .copy-btn:hover { background: #ff385c; transform: scale(1.1); }

        .booking-number {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 5px;
            background: linear-gradient(90deg, #fff, #b8bfd1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Accommodations Layout */
        .room-image {
            height: 200px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            background: linear-gradient(135deg, rgba(255, 56, 92, .6), rgba(59, 130, 246, .6));
        }

        .room-features { display: flex; flex-wrap: wrap; gap: 20px; }
        .room-features div { background: rgba(255, 255, 255, .08); padding: 10px 15px; border-radius: 20px; font-size: 14px; }

        /* Timeline Components */
        .timeline { position: relative; }
        .timeline::before {
            content: "";
            position: absolute;
            left: 25px;
            top: 20px;
            height: 85%;
            width: 2px;
            background: rgba(255, 255, 255, .2);
        }

        .timeline-item { display: flex; gap: 25px; margin-bottom: 35px; position: relative; }
        .timeline-dot {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .15);
            z-index: 2;
        }
        .timeline-item.active .timeline-dot { background: #22c55e; }

        .event-icon, .notes-icon, .confirm-icon, .mini-logo {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            background: rgba(255, 255, 255, .12);
        }

        /* Invoice/Receipt Section */
        .receipt-status { padding: 10px 18px; border-radius: 30px; background: rgba(245, 158, 11, .15); color: #fbbf24; }
        .receipt-item { padding: 15px; border-radius: 18px; background: rgba(255, 255, 255, .06); margin-bottom: 15px; }
        .receipt-item label { font-size: 12px; opacity: .65; display: block; }
        .receipt-item h6 { margin-top: 8px; font-weight: 700; }
        .schedule-box { padding: 25px; border-radius: 25px; background: rgba(255, 255, 255, .08); }

        /* Sidebar Configurations */
        .quick-summary { background: rgba(255, 255, 255, .06); border-radius: 22px; padding: 20px; }
        .quick-summary div { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255, 255, 255, .1); }
        .quick-summary div:last-child { border-bottom: none; }
        .quick-summary span { color: #b8bfd1; font-size: 14px; }
        .quick-summary strong { font-size: 14px; }

        .security-box {
            display: flex; gap: 15px; align-items: center; padding: 18px; border-radius: 22px;
            background: rgba(34, 197, 94, .12); border: 1px solid rgba(34, 197, 94, .25);
        }
        .security-box i { font-size: 32px; color: #22c55e; }
        .security-box h6 { margin: 0; font-weight: 700; }
        .security-box p { margin: 4px 0 0; font-size: 13px; opacity: .75; }

        /* Action Controls & Buttons */
        .actions { display: flex; flex-direction: column; gap: 12px; }
        .premium-btn {
            width: 100%; border: none; padding: 15px 20px; border-radius: 18px;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            font-weight: 700; text-decoration: none; font-size: 15px; cursor: pointer; transition: .35s ease;
        }
        .premium-btn:hover { transform: translateY(-4px) scale(1.02); }
        .premium-btn.primary { background: linear-gradient(135deg, #ff385c, #e11d48); color: white; }
        .premium-btn.secondary { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
        .premium-btn.dark { background: rgba(255, 255, 255, .12); color: white; border: 1px solid rgba(255, 255, 255, .15); }
        .premium-btn.success { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; }
        .premium-btn.danger { background: linear-gradient(135deg, #9333ea, #7e22ce); color: white; }

        /* Footer Utilities */
        .footer-icons { display: flex; justify-content: center; gap: 18px; margin-top: 20px; }
        .footer-icons i {
            width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            background: rgba(255, 255, 255, .1); font-size: 18px; transition: .3s; cursor: pointer;
        }
        .footer-icons i:hover { background: #ff385c; transform: translateY(-5px); }

        /* Custom Interactive Components */
        .premium-toast {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px);
            background: rgba(20, 20, 30, .85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, .2);
            padding: 15px 25px; border-radius: 50px; color: white; font-weight: 600; display: flex;
            align-items: center; gap: 10px; z-index: 9999; transition: .5s; box-shadow: 0 20px 50px rgba(0, 0, 0, .4);
        }
        .premium-toast i { color: #22c55e; font-size: 20px; }
        .premium-toast.show { transform: translateX(-50%) translateY(0); }

        .confetti { position: fixed; top: -20px; width: 12px; height: 20px; background: linear-gradient(135deg, #ff385c, #3b82f6); animation: fall linear forwards; z-index: 9998; }
        @keyframes fall {
            from { transform: translateY(-20px) rotate(0); opacity: 1; }
            to { transform: translateY(110vh) rotate(720deg); opacity: 0; }
        }

        .particle { position: fixed; bottom: -20px; width: 8px; height: 8px; background: rgba(255, 255, 255, .5); border-radius: 50%; animation: particleFloat linear infinite; z-index: -1; }
        @keyframes particleFloat {
            from { transform: translateY(0) scale(1); opacity: 0; }
            20% { opacity: 1; }
            to { transform: translateY(-120vh) scale(1.5); opacity: 0; }
        }

        /* Universal Scrollbar Styling */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #070b16; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(#ff385c, #3b82f6); border-radius: 20px; }

        /* Responsive Breakpoints */
        @media(max-width: 992px) {
            .page { padding: 35px 15px; }
            .glass { border-radius: 22px; }
            h1 { font-size: 38px!important; }
            .booking-number { font-size: 24px; }
        }

        @media(max-width: 576px) {
            body { align-items: flex-start; }
            .page { padding-top: 20px; }
            .glass { padding: 25px!important; }
            .display-5 { font-size: 32px; }
            .room-image { height: 150px; font-size: 60px; }
            .room-features { flex-direction: column; gap: 10px; }
            .timeline::before { left: 20px; }
            .timeline-dot { width: 40px; height: 40px; }
            .detail-row { flex-direction: column; gap: 5px; }
            .schedule-box h5 { font-size: 14px; }
        }

        /* Hardcopy Printing Support */
        @media print {
            body { background: white!important; color: black!important; }
            .blob, .premium-btn, .actions, .footer, .particle, .confetti { display: none!important; }
            .glass { background: white!important; color: black!important; box-shadow: none; border: 1px solid #ddd; }
            .text-light, .opacity-75 { color: #333!important; opacity: 1!important; }
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

    <div class="blob one"></div>
    <div class="blob two"></div>
    <div class="blob three"></div>

    <div class="page">
        <div class="container-fluid">
            <div class="row g-4 align-items-start">
                
                <!-- LEFT MAIN LAYOUT -->
                <div class="col-lg-8">
                    <div class="glass p-5">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div>
                                <span class="badge rounded-pill bg-success px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i> BOOKING COMPLETED
                                </span>
                                <h1 class="display-5 fw-bold mt-4 mb-2">Your Reservation is Confirmed</h1>
                                <p class="text-light opacity-75 fs-5">
                                    Thank you for choosing <strong>Tigno </strong>. Your reservation has been successfully recorded and is now awaiting confirmation from our team.
                                </p>
                            </div>
                            <div class="text-center">
                                <div class="success-circle">
                                    <svg width="110" height="110" viewBox="0 0 120 120">
                                        <circle cx="60" cy="60" r="52" stroke="rgba(255,255,255,.18)" stroke-width="8" fill="none"/>
                                        <circle class="progress-ring" cx="60" cy="60" r="52" stroke="#22c55e" stroke-width="8" fill="none" stroke-linecap="round"/>
                                        <path class="checkmark" d="M38 62 L54 77 L84 45" fill="none" stroke="#22c55e" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5 border-secondary">

                        <!-- Profile and Summary Meta Blocks -->
                        <div class="row g-4 mt-3">
                            <!-- Guest Profile Data -->
                            <div class="col-md-6">
                                <div class="info-card glass p-4 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            {{ strtoupper(substr(session('full_name') ?? session('customer_name'),0,1)) }}
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">{{ session('full_name') ?? session('customer_name') }}</h5>
                                            <p class="mb-0 text-light opacity-75"><i class="bi bi-person-check me-1"></i> Guest Account</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="detail-row">
                                            <span><i class="bi bi-envelope"></i> Email</span>
                                            <strong>{{ session('email') }}</strong>
                                        </div>
                                        <div class="detail-row">
                                            <span><i class="bi bi-telephone"></i> Contact</span>
                                            <strong>{{ session('country_code') }} {{ session('contact') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Unique Booking Key -->
                            <div class="col-md-6">
                                <div class="info-card glass p-4 h-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0">Booking Reference</h5>
                                        <button class="copy-btn" onclick="copyBookingID()"><i class="bi bi-copy"></i></button>
                                    </div>
                                    <div class="booking-number mt-4">{{ session('booking_id') }}</div>
                                    <p class="small text-light opacity-75 mt-3 mb-0">Keep this reference number for your reservation tracking.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Room Allocation Details -->
                        <div class="room-card glass mt-4 p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="room-image"><i class="bi bi-building"></i></div>
                                </div>
                                <div class="col-md-8">
                                    <span class="small text-uppercase opacity-75">Selected Accommodation</span>
                                    <h2 class="fw-bold mt-2">{{ session('room_type') ?? 'Standard Room' }}</h2>
                                    <p class="text-light opacity-75">Comfortable accommodation prepared for your event reservation.</p>
                                    <div class="room-features">
                                        <div><i class="bi bi-people-fill text-primary"></i> {{ session('guests') }} Guests</div>
                                        <div><i class="bi bi-calendar-check text-secondary"></i> Reserved</div>
                                        <div><i class="bi bi-shield-check text-success"></i> Secure Booking</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chronological Milestones -->
                        <div class="timeline-card glass mt-4 p-5">
                            <h3 class="fw-bold mb-5"><i class="bi bi-calendar-event me-2"></i> Reservation Timeline</h3>
                            <div class="timeline">
                                <div class="timeline-item active">
                                    <div class="timeline-dot"><i class="bi bi-check"></i></div>
                                    <div>
                                        <h6 class="fw-bold">Booking Created</h6>
                                        <p class="opacity-75 mb-0">Reservation successfully submitted</p>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-dot"><i class="bi bi-house-check"></i></div>
                                    <div>
                                        <h6 class="fw-bold">Room Reserved</h6>
                                        <p class="opacity-75 mb-0">{{ session('room_type') ?? 'Standard Room' }}</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot"><i class="bi bi-clock"></i></div>
                                    <div>
                                        <h6 class="fw-bold">Schedule</h6>
                                        <p class="opacity-75 mb-0">
                                            {{ session('booking_datetime') }} <br> ↓ <br> {{ session('end_datetime') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Linked Event Details -->
                        <div class="event-card glass mt-4 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="event-icon"><i class="bi bi-stars"></i></div>
                                <div>
                                    <h4 class="fw-bold mb-1">{{ session('event_name') ?? 'Event Selected' }}</h4>
                                    <p class="mb-0 opacity-75">Special reservation event</p>
                                </div>
                            </div>
                        </div>

                        <!-- Printable Virtual Receipt Breakdown -->
                        <div class="receipt glass mt-4 p-5">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div>
                                    <h3 class="fw-bold mb-1">Booking Receipt</h3>
                                    <p class="opacity-75 mb-0">Official reservation summary</p>
                                </div>
                                <div class="receipt-status"><i class="bi bi-hourglass-split"></i> Pending Confirmation</div>
                            </div>
                            <hr class="my-4 border-secondary">
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="receipt-item">
                                        <label>Customer Name</label>
                                        <h6>{{ session('full_name') ?? session('customer_name') }}</h6>
                                    </div>
                                    <div class="receipt-item">
                                        <label>Email Address</label>
                                        <h6>{{ session('email') }}</h6>
                                    </div>
                                    <div class="receipt-item">
                                        <label>Contact Number</label>
                                        <h6>{{ session('country_code') }} {{ session('contact') }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="receipt-item">
                                        <label>Booking ID</label>
                                        <h6 id="bookingID">{{ session('booking_id') }}</h6>
                                    </div>
                                    <div class="receipt-item">
                                        <label>Room Type</label>
                                        <h6>{{ session('room_type') ?? 'Standard Room' }}</h6>
                                    </div>
                                    <div class="receipt-item">
                                        <label>Number of Guests</label>
                                        <h6>{{ session('guests') }}</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="schedule-box mt-4">
                                <div class="row text-center align-items-center">
                                    <div class="col-md-5">
                                        <span class="small text-muted d-block mb-1">CHECK-IN</span>
                                        <h5>{{ session('booking_datetime') }}</h5>
                                    </div>
                                    <div class="col-md-2 my-2 my-md-0">
                                        <i class="bi bi-arrow-right fs-2"></i>
                                    </div>
                                    <div class="col-md-5">
                                        <span class="small text-muted d-block mb-1">CHECK-OUT</span>
                                        <h5>{{ session('end_datetime') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Custom User Requests Block -->
                        <div class="notes-card glass mt-4 p-4">
                            <div class="d-flex gap-3 align-items-start">
                                <div class="notes-icon"><i class="bi bi-chat-left-text"></i></div>
                                <div>
                                    <h5 class="fw-bold">Special Notes</h5>
                                    <p class="opacity-75 mb-0">{{ session('notes') ?? 'No additional notes provided.' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- System Review Advisory Card -->
                        <div class="confirmation glass mt-4 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="confirm-icon"><i class="bi bi-check-lg"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-1">Thank you for your reservation</h5>
                                    <p class="mb-0 opacity-75">Our team will review your booking and contact you for final confirmation.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT PERSISTENT PANEL -->
                <div class="col-lg-4">
                    <div class="glass sidebar p-4">
                        <div class="text-center mb-4">
                            <div class="mini-logo mx-auto"><i class="bi bi-building-check"></i></div>
                            <h4 class="fw-bold mt-3">Tigno Booking</h4>
                            <p class="opacity-75">Premium Reservation System</p>
                        </div>

                        <div class="quick-summary">
                            <div><span>Status</span><strong>Confirmed Request</strong></div>
                            <div><span>Room</span><strong>{{ session('room_type') ?? 'Standard' }}</strong></div>
                            <div><span>Guests</span><strong>{{ session('guests') }}</strong></div>
                        </div>

                        <div class="security-box mt-4">
                            <i class="bi bi-shield-lock-fill"></i>
                            <div>
                                <h6>Secure Reservation</h6>
                                <p>Your booking information is safely stored.</p>
                            </div>
                        </div>

                        <!-- User Execution Trigger Interfaces -->
                        <div class="actions mt-4">
                            <button class="premium-btn primary" onclick="printBooking()">
                                <i class="bi bi-printer-fill"></i> Print Booking
                            </button>
                            <button class="premium-btn secondary" onclick="downloadReceipt()">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Download Receipt
                            </button>
                            <button class="premium-btn dark" onclick="copyBookingID()">
                                <i class="bi bi-copy"></i> Copy Booking ID
                            </button>
                            <a href="/dashboard" class="premium-btn success">
                                <i class="bi bi-house-door-fill"></i> Back Dashboard
                            </a>
                            <a href="{{ route('booking.details') }}" class="premium-btn danger">
                                <i class="bi bi-plus-circle-fill"></i> Create New Booking
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- SITE FOOTER -->
            <div class="footer glass mt-5 p-4 text-center">
                <h5 class="fw-bold">Thank you for choosing Tigno Booking</h5>
                <p class="opacity-75 mb-2">Luxury events. Simple reservations.</p>
                <div class="footer-icons">
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-envelope"></i>
                    <i class="bi bi-globe"></i>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT INFRASTRUCTURE -->
    <script>
        /* ====================================
           COPY BOOKING REFERENCE
        ==================================== */
        function copyBookingID(){
            let bookingID = document.getElementById("bookingID").innerText.trim();
            navigator.clipboard.writeText(bookingID);
            showToast("Booking ID copied successfully!");
        }

        /* ====================================
           SYSTEM TRIGGER PRINT DIALOGUE
        ==================================== */
        function printBooking(){
            window.print();
        }

        /* ====================================
           PARSE DATA & COMPILE TEXT INVOICE
        ==================================== */
        function downloadReceipt(){
            let receipt = `TIGNO BOOKING RECEIPT\n\n` +
                          `Booking ID: {{ session('booking_id') }}\n` +
                          `Customer: {{ session('full_name') ?? session('customer_name') }}\n` +
                          `Email: {{ session('email') }}\n` +
                          `Contact: {{ session('country_code') }} {{ session('contact') }}\n` +
                          `Room: {{ session('room_type') ?? 'Standard Room' }}\n` +
                          `Guests: {{ session('guests') }}\n\n` +
                          `Schedule: {{ session('booking_datetime') }} Until {{ session('end_datetime') }}\n\n` +
                          `Event: {{ session('event_name') ?? 'Event Selected' }}\n` +
                          `Notes: {{ session('notes') ?? 'No notes' }}\n\n` +
                          `Thank you for choosing Tigno Booking.`;

            let blob = new Blob([receipt], { type: "text/plain" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "Tigno_Booking_Receipt.txt";
            link.click();
            showToast("Receipt downloaded!");
        }

        /* ====================================
           RENDER INTERACTIVE UI SNACKBAR
        ==================================== */
        function showToast(message){
            let toast = document.createElement("div");
            toast.className = "premium-toast";
            toast.innerHTML = `<i class="bi bi-check-circle-fill"></i> ${message}`;
            document.body.appendChild(toast);

            setTimeout(() => { toast.classList.add("show"); }, 100);
            setTimeout(() => {
                toast.classList.remove("show");
                setTimeout(() => { toast.remove(); }, 500);
            }, 3000);
        }

        /* ====================================
           ASYNCHRONOUS INITIALIZATION ENGINE
        ==================================== */
        window.addEventListener("load", () => {
            // Sequential Layout Fade-in Delays
            document.querySelectorAll(".glass").forEach((element, index) => {
                element.style.animationDelay = (index * 0.12) + "s";
                element.classList.add("fadeUp");
            });

            // Delayed Particle System Initialization
            setTimeout(createConfetti, 800);
            createParticles();
            updateBookingStatus();
            initActionEffects();
        });

        /* ====================================
           DYNAMIC VISUAL EFFECT SYSTEMS
        ==================================== */
        function createConfetti(){
            for(let i = 0; i < 60; i++){
                let confetti = document.createElement("span");
                confetti.className = "confetti";
                confetti.style.left = Math.random() * 100 + "vw";
                confetti.style.animationDuration = (2 + Math.random() * 3) + "s";
                confetti.style.animationDelay = Math.random() + "s";
                document.body.appendChild(confetti);
                setTimeout(() => { confetti.remove(); }, 5000);
            }
        }

        function createParticles(){
            for(let i = 0; i < 25; i++){
                let particle = document.createElement("div");
                particle.className = "particle";
                particle.style.left = Math.random() * 100 + "%";
                particle.style.animationDuration = (8 + Math.random() * 8) + "s";
                particle.style.animationDelay = Math.random() * 5 + "s";
                document.body.appendChild(particle);
            }
        }

        function updateBookingStatus(){
            let status = document.querySelector(".receipt-status");
            if(status){
                setTimeout(() => {
                    status.innerHTML = `<i class="bi bi-check-circle-fill"></i> Reservation Received`;
                    status.style.background = "rgba(34, 197, 94, .15)";
                    status.style.color = "#22c55e";
                }, 2000);
            }
        }

        function initActionEffects(){
            document.querySelectorAll(".premium-btn, .copy-btn").forEach(button => {
                button.addEventListener("click", () => {
                    button.style.transform = "scale(.95)";
                    setTimeout(() => { button.style.transform = ""; }, 150);
                });
            });

            document.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", function() {
                    this.style.opacity = ".7";
                });
            });
        }

        /* ====================================
           DATA SECURITY & PREVENTIONS
        ==================================== */
        document.addEventListener("contextmenu", event => {
            if(event.target.closest(".receipt")) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>