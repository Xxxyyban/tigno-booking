<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Details — Enterprise Admin Dashboard</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-base: #070b16;
            --bg-surface: rgba(15, 23, 42, 0.7);
            --bg-surface-hover: rgba(255, 255, 255, 0.06);
            --border-glass: rgba(255, 255, 255, 0.08);
            --border-glass-focus: rgba(255, 56, 92, 0.4);
            --primary: #ff385c;
            --primary-glow: rgba(255, 56, 92, 0.25);
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
                radial-gradient(circle at 10% 20%, rgba(30, 27, 75, 0.6) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(15, 23, 42, 0.8) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(88, 28, 135, 0.15) 0%, transparent 60%);
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
            background: rgba(255, 56, 92, 0.6);
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
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
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
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #ff385c, #e11d48);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px var(--primary-glow);
            color: white;
            font-size: 1.1rem;
        }

        .nav-menu {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
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
            background: linear-gradient(135deg, rgba(255, 56, 92, 0.18), rgba(225, 29, 72, 0.08));
            border: 1px solid rgba(255, 56, 92, 0.25);
            color: #ff859b;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(255, 56, 92, 0.1);
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
            border-color: rgba(239, 68, 68, 0.3);
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
            background: rgba(15, 23, 42, 0.5);
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
            border-color: rgba(255, 255, 255, 0.15);
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
            box-shadow: 0 6px 20px rgba(147, 51, 234, 0.3);
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
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .details-container {
            max-width: 900px;
            margin: auto;
        }

        .enterprise-card {
            background: var(--bg-surface);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 40px;
            color: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title i {
            color: var(--primary);
            filter: drop-shadow(0 4px 12px var(--primary-glow));
        }

        .enterprise-divider {
            border-color: var(--border-glass);
            margin: 25px 0 30px 0;
        }

        /* Custom Information Rows */
        .row-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
        }

        .row-box:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.12);
        }

        .row-box strong {
            color: #ff859b;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
        }

        .row-box .value-text {
            font-size: 0.95rem;
            margin-top: 6px;
            color: #f8fafc;
            font-weight: 500;
        }

        /* Action Buttons */
        .btn-back {
            background: linear-gradient(135deg, #ff385c, #e11d48);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 8px 25px var(--primary-glow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #e11d48, #be123c);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(255, 56, 92, 0.4);
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
            <span>Admin Panel</span>
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
                <span>Calendar</span>
            </a>

            <a href="#" class="nav-item">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>

            <a href="#" class="nav-item">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
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
            <input type="text" placeholder="Search bookings, users, rooms...">
        </div>

        <div class="admin-nav-actions">
            <a href="#" class="icon-btn" title="Notifications">
                <i class="bi bi-bell"></i>
                <span class="badge-dot"></span>
            </a>

            <a href="#" class="icon-btn" title="Settings">
                <i class="bi bi-gear"></i>
            </a>

            <div class="admin-profile">
                <div class="admin-avatar">AD</div>
                <div class="admin-info d-none d-md-block">
                    <div class="name">Administrator</div>
                    <div class="role">System Manager</div>
                </div>
            </div>
        </div>
    </header>

    <!-- =========================
       MAIN BODY WORKSPACE
    ========================= -->
    <main class="main-content">
        <div class="details-container">
            <div class="enterprise-card">

                <div class="card-header-flex">
                    <h2 class="card-title">
                        <i class="bi bi-info-circle-fill"></i>
                        Booking Information
                    </h2>
                    <span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-25 px-3 py-2 rounded-pill font-monospace" style="font-size: 0.85rem;">#{{ $booking->booking_id }}</span>
                </div>

                <hr class="enterprise-divider">

                <div class="row">
                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Booking ID</strong>
                            <div class="value-text">{{ $booking->booking_id }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Customer Name</strong>
                            <div class="value-text">{{ $booking->first_name }} {{ $booking->last_name }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Email Address</strong>
                            <div class="value-text">{{ $booking->email }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Contact Number</strong>
                            <div class="value-text">{{ $booking->country_code ?? '' }} {{ $booking->contact }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Check-in Date & Time</strong>
                            <div class="value-text">{{ $booking->booking_datetime }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Check-out Date & Time</strong>
                            <div class="value-text">{{ $booking->end_datetime }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Number of Guests</strong>
                            <div class="value-text">{{ $booking->guests }} Guest(s)</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row-box">
                            <strong>Room Type</strong>
                            <div class="value-text">{{ $booking->room_type }}</div>
                        </div>
                    </div>
                </div>

                <div class="row-box">
                    <strong>Special Notes / Requests</strong>
                    <div class="value-text">{{ $booking->notes ?: 'No special notes provided.' }}</div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.bookings.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Back to Bookings
                    </a>
                </div>

            </div>
        </div>
    </main>

</body>
</html>