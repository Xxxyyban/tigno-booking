<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard — Enterprise Control Center</title>

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

        .welcome-banner {
            margin-bottom: 35px;
        }

        .welcome-banner h1 {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .welcome-banner p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin: 0;
            font-weight: 400;
        }

        /* =========================
           STATS METRICS GRID
        ========================= */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--bg-surface);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--border-glass);
            padding: 24px;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 56, 92, 0.5), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(15, 23, 42, 0.85);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-glass);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .stat-title {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            color: #fff;
        }

        /* =========================
           DASHBOARD SECTIONS & PANELS
        ========================= */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .enterprise-panel {
            background: var(--bg-surface);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--border-glass);
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .panel-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .view-all-link {
            font-size: 0.85rem;
            font-weight: 600;
            color: #ff859b;
            text-decoration: none;
            transition: opacity 0.2s ease;
        }

        .view-all-link:hover {
            opacity: 0.8;
            color: var(--primary);
        }

        /* =========================
           ADVANCED TABLE STYLING
        ========================= */
        .enterprise-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .enterprise-table th {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            background: transparent;
            border: none;
            padding: 0 16px 12px 16px;
        }

        .enterprise-table td {
            background: rgba(255, 255, 255, 0.02);
            border-top: 1px solid var(--border-glass);
            border-bottom: 1px solid var(--border-glass);
            padding: 16px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            vertical-align: middle;
        }

        .enterprise-table tr td:first-child {
            border-left: 1px solid var(--border-glass);
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
            font-family: monospace;
            color: #ff859b;
            font-weight: 600;
        }

        .enterprise-table tr td:last-child {
            border-right: 1px solid var(--border-glass);
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
        }

        .enterprise-table tbody tr {
            transition: all 0.2s ease;
        }

        .enterprise-table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
        }

        /* =========================
           ACTION BUTTONS
        ========================= */
        .btn-action-modern {
            background: linear-gradient(135deg, rgba(255, 56, 92, 0.1), rgba(225, 29, 72, 0.05));
            border: 1px solid rgba(255, 56, 92, 0.25);
            padding: 14px 20px;
            border-radius: 14px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
        }

        .btn-action-modern i {
            font-size: 1.1rem;
            color: var(--primary);
            transition: transform 0.2s ease;
        }

        .btn-action-modern:hover {
            background: linear-gradient(135deg, #ff385c, #e11d48);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--primary-glow);
        }

        .btn-action-modern:hover i {
            color: white;
            transform: scale(1.1);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1200px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .dashboard-layout {
                grid-template-columns: 1fr;
            }
        }

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
            .card-grid {
                grid-template-columns: 1fr;
            }
            .main-content {
                padding: 20px;
            }
            .enterprise-panel {
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
            <a href="/admin/dashboard" class="nav-item active">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('bookings.index') }}" class="nav-item">
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
        
        <!-- Welcome Header -->
        <div class="welcome-banner">
            <h1>Welcome Back, Admin 👋</h1>
            <p>Here is what's happening with your property bookings and performance today.</p>
        </div>

        <!-- Metrics Cards Grid -->
        <div class="card-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Bookings</div>
                    <div class="stat-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                </div>
                <div class="stat-value">{{ \App\Models\Booking::count() }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Active Rooms</div>
                    <div class="stat-icon"><i class="bi bi-door-open-fill"></i></div>
                </div>
                <div class="stat-value">12</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Today's Bookings</div>
                    <div class="stat-icon"><i class="bi bi-calendar-day-fill"></i></div>
                </div>
                <div class="stat-value">5</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Revenue</div>
                    <div class="stat-icon"><i class="bi bi-wallet2"></i></div>
                </div>
                <div class="stat-value">₱25,000</div>
            </div>
        </div>

        <!-- Content Layout Matrix -->
        <div class="dashboard-layout">
            
            <!-- Recent Bookings Table Panel -->
            <div class="enterprise-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="bi bi-clock-history text-danger"></i> Recent Bookings
                    </h3>
                    <a href="{{ route('bookings.index') }}" class="view-all-link">View All &rarr;</a>
                </div>

                <div class="table-responsive">
                    <table class="enterprise-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Room Type</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Booking::latest()->take(5)->get() as $b)
                            <tr>
                                <td>#{{ $b->booking_id }}</td>
                                <td>{{ $b->first_name }}</td>
                                <td>{{ $b->room_type }}</td>
                                <td>{{ $b->booking_datetime }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Management Actions Panel -->
            <div class="enterprise-panel">
                <div class="panel-header">
                    <h3 class="panel-title">
                        <i class="bi bi-lightning-fill text-danger"></i> Quick Actions
                    </h3>
                </div>

                <div class="d-flex flex-column gap-3 mt-4">
                    <a href="{{ route('bookings.index') }}" class="btn-action-modern">
                        <i class="bi bi-calendar-check"></i>
                        <span>Manage Bookings</span>
                    </a>

                    <a href="{{ route('admin.calendar') }}" class="btn-action-modern">
                        <i class="bi bi-calendar3"></i>
                        <span>View Calendar</span>
                    </a>

                    <a href="#" class="btn-action-modern">
                        <i class="bi bi-plus-circle"></i>
                        <span>Add New Room</span>
                    </a>
                </div>
            </div>

        </div>

    </main>

</body>
</html>