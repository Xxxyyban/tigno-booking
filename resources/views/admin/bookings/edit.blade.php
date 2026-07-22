<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Booking Matrix — Enterprise Admin Dashboard</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-base: #040711;
            --bg-surface: rgba(13, 20, 36, 0.75);
            --bg-surface-hover: rgba(255, 255, 255, 0.08);
            --border-glass: rgba(255, 255, 255, 0.09);
            --border-glass-focus: rgba(255, 56, 92, 0.5);
            --primary: #ff385c;
            --primary-glow: rgba(255, 56, 92, 0.3);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --sidebar-width: 270px;
            --navbar-height: 80px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-base);
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(49, 36, 129, 0.5) 0%, transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(15, 23, 42, 0.9) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(126, 34, 206, 0.12) 0%, transparent 70%);
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.4);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 56, 92, 0.7);
        }

        /* =========================
           SIDEBAR STYLING
        ========================= */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--bg-surface);
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            border-right: 1px solid var(--border-glass);
            padding: 24px 20px;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            padding: 0 10px;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ff385c, #e11d48);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px var(--primary-glow);
            color: white;
            font-size: 1.2rem;
        }

        .nav-menu {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 14px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.88rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item i {
            font-size: 1.15rem;
            transition: transform 0.2s ease;
        }

        .nav-item:hover {
            background: var(--bg-surface-hover);
            color: #ffffff;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(255, 56, 92, 0.2), rgba(225, 29, 72, 0.08));
            border: 1px solid rgba(255, 56, 92, 0.3);
            color: #ff859b;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(255, 56, 92, 0.12);
        }

        .sidebar-footer {
            padding-top: 20px;
            border-top: 1px solid var(--border-glass);
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            color: var(--text-muted);
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            text-align: left;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.35);
            color: #f87171;
            transform: translateY(-1px);
        }

        /* =========================
           TOP NAVBAR STYLING
        ========================= */
        .admin-navbar {
            margin-left: var(--sidebar-width);
            height: var(--navbar-height);
            padding: 0 40px;
            background: rgba(13, 20, 36, 0.6);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-bottom: 1px solid var(--border-glass);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .admin-navbar-search {
            position: relative;
            width: 380px;
        }

        .admin-navbar-search input {
            width: 100%;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-glass);
            padding: 11px 16px 11px 44px;
            border-radius: 14px;
            color: white;
            font-size: 0.88rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-navbar-search input::placeholder {
            color: var(--text-muted);
        }

        .admin-navbar-search input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--border-glass-focus);
            box-shadow: 0 0 20px var(--primary-glow);
        }

        .admin-navbar-search i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
        }

        .admin-nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-glass);
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            position: relative;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .icon-btn:hover {
            background: var(--bg-surface-hover);
            border-color: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }

        .icon-btn .badge-dot {
            position: absolute;
            top: 11px;
            right: 11px;
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--primary);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-left: 16px;
            border-left: 1px solid var(--border-glass);
        }

        .admin-avatar {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #ff385c, #9333ea);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 6px 20px rgba(147, 51, 234, 0.35);
            letter-spacing: 0.5px;
        }

        .admin-info .name {
            font-size: 0.88rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .admin-info .role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* =========================
           MAIN CONTENT AREA
        ========================= */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px;
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .edit-container {
            max-width: 980px;
            margin: auto;
        }

        .enterprise-card {
            background: var(--bg-surface);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid var(--border-glass);
            border-radius: 28px;
            padding: 48px;
            color: white;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.55);
            position: relative;
            overflow: hidden;
        }

        .enterprise-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .card-title i {
            color: var(--primary);
            font-size: 1.4rem;
            filter: drop-shadow(0 4px 15px var(--primary-glow));
        }

        .back-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateX(-2px);
        }

        .enterprise-divider {
            border-color: var(--border-glass);
            margin: 30px 0 40px 0;
        }

        /* Section Grouping */
        .form-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-section-title i {
            color: var(--primary);
        }

        /* Form Controls */
        .form-label-custom {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.04) !important;
            color: white !important;
            border: 1px solid var(--border-glass) !important;
            border-radius: 14px !important;
            padding: 13px 18px !important;
            font-size: 0.9rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .form-control::placeholder {
            color: rgba(148, 163, 184, 0.4);
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.07) !important;
            border-color: var(--border-glass-focus) !important;
            box-shadow: 0 0 20px var(--primary-glow) !important;
        }

        .form-select option {
            background: #0f172a;
            color: white;
            padding: 10px;
        }

        /* Custom invalid states if needed */
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #ef4444 !important;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.25) !important;
        }

        .btn-update {
            background: linear-gradient(135deg, #ff385c, #e11d48);
            color: white;
            width: 100%;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.95rem;
            margin-top: 35px;
            box-shadow: 0 10px 30px var(--primary-glow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
        }

        .btn-update:hover {
            background: linear-gradient(135deg, #e11d48, #be123c);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(255, 56, 92, 0.45);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 20px 12px;
            }
            .sidebar-brand span, .nav-item span, .sidebar-footer span {
                display: none;
            }
            .sidebar-brand {
                justify-content: center;
                padding: 0;
            }
            .admin-navbar, .main-content {
                margin-left: 80px;
            }
            .admin-navbar {
                padding: 0 20px;
            }
            .admin-navbar-search {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .enterprise-card {
                padding: 24px;
            }
            .main-content {
                padding: 20px;
            }
            .card-header-flex {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- =========================
       SIDEBAR NAVIGATION MATRIX
    ========================= -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <span>Tigno Core</span>
        </div>

        <nav class="nav-menu">
            <a href="/admin/dashboard" class="nav-item">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="nav-item active">
                <i class="bi bi-calendar-check"></i>
                <span>Bookings</span>
            </a>

            <a href="{{ route('admin.calendar') }}" class="nav-item">
                <i class="bi bi-calendar3"></i>
                <span>Calendar Matrix</span>
            </a>

            <a href="#" class="nav-item">
                <i class="bi bi-people"></i>
                <span>Client Users</span>
            </a>

            <a href="#" class="nav-item">
                <i class="bi bi-gear"></i>
                <span>System Config</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Terminate Session</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- =========================
       ADMIN TOP NAVIGATION BAR
    ========================= -->
    <header class="admin-navbar">
        <div class="admin-navbar-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Global search bookings, users, or rooms...">
        </div>

        <div class="admin-nav-actions">
            <a href="#" class="icon-btn" title="System Notifications">
                <i class="bi bi-bell"></i>
                <span class="badge-dot"></span>
            </a>

            <div class="admin-profile">
                <div class="admin-avatar">AD</div>
                <div class="admin-info d-none d-md-block">
                    <div class="name">Administrator</div>
                    <div class="role">Executive Controller</div>
                </div>
            </div>
        </div>
    </header>

    <!-- =========================
       MAIN BODY WORKSPACE
    ========================= -->
    <main class="main-content">
        <div class="edit-container">
            <div class="enterprise-card">

                <div class="card-header-flex">
                    <h2 class="card-title">
                        <i class="bi bi-pencil-square"></i>
                        Edit Booking Record
                    </h2>
                    <a href="{{ route('admin.bookings.index') }}" class="back-link">
                        <i class="bi bi-arrow-left"></i> Return to Matrix
                    </a>
                </div>

                <hr class="enterprise-divider">

                <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Section: Core Data -->
                    <div class="form-section-title">
                        <i class="bi bi-shield-lock-fill"></i> Primary Transaction Identifiers
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Booking ID Token</label>
                            <input type="text" name="booking_id" class="form-control" value="{{ old('booking_id', $booking->booking_id) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Associated Event Type</label>
                            <select name="event_id" class="form-select" required>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ $booking->event_id == $event->id ? 'selected' : '' }}>
                                        {{ $event->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Section: Client Details -->
                    <div class="form-section-title mt-4">
                        <i class="bi bi-person-badge-fill"></i> Client Contact Information
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-12">
                            <label class="form-label-custom">Client Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $booking->full_name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $booking->email) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Contact Telephone</label>
                            <input type="text" name="contact" class="form-control" value="{{ old('contact', $booking->contact) }}" required>
                        </div>
                    </div>

                    <!-- Section: Logistics & Schedule -->
                    <div class="form-section-title mt-4">
                        <i class="bi bi-clock-history"></i> Scheduling & Resource Configuration
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Check-In Activation Window</label>
                            <input type="datetime-local" name="booking_datetime" class="form-control" value="{{ old('booking_datetime', $booking->booking_datetime) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Check-Out Termination Window</label>
                            <input type="datetime-local" name="end_datetime" class="form-control" value="{{ old('end_datetime', $booking->end_datetime) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Number of Guests</label>
                            <input type="number" name="guests" class="form-control" value="{{ old('guests', $booking->guests) }}" min="1" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Assigned Room Space</label>
                            <select name="room_type" class="form-select" required>
                                <option value="Prince" {{ $booking->room_type == 'Prince' ? 'selected' : '' }}>Prince Suite</option>
                                <option value="King" {{ $booking->room_type == 'King' ? 'selected' : '' }}>King Suite</option>
                                <option value="VIP" {{ $booking->room_type == 'VIP' ? 'selected' : '' }}>VIP Lounge</option>
                                <option value="Elite" {{ $booking->room_type == 'Elite' ? 'selected' : '' }}>Elite Chamber</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label-custom">Operational Notes & Remarks</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Enter optional administrative remarks here...">{{ old('notes', $booking->notes) }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-update">
                        <i class="bi bi-check-circle-fill fs-5"></i> Commit Booking Updates
                    </button>
                </form>

            </div>
        </div>
    </main>

</body>
</html>