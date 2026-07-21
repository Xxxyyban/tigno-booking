<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Bookings — Enterprise Admin Dashboard</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FullCalendar 6.1.11 -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <style>
        :root {
            --bg-base: #070b16;
            --bg-surface: rgba(15, 23, 42, 0.75);
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
            justify-content: flex-end;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .admin-nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
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

        .container-box {
            max-width: 1440px;
            margin: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
        }

        .page-title i {
            color: var(--primary);
            filter: drop-shadow(0 4px 12px var(--primary-glow));
        }

        .btn-dashboard {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            text-decoration: none;
            padding: 11px 20px;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-dashboard:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.45);
        }

        /* =========================
            CALENDAR PANEL (EXPANDED)
        ========================= */
        .calendar-wrapper {
            background: var(--bg-surface);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--border-glass);
            padding: 32px;
            border-radius: 24px;
            margin-bottom: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        #calendar {
            color: white;
            min-height: 720px;
        }

        /* FullCalendar Custom Dark Overrides */
        .fc {
            --fc-page-bg-color: transparent;
            --fc-neutral-bg-color: rgba(255, 255, 255, 0.02);
            --fc-neutral-border-color: var(--border-glass);
            --fc-border-color: var(--border-glass);
            --fc-today-bg-color: rgba(255, 56, 92, 0.08);
            --fc-event-bg-color: var(--primary);
            --fc-event-border-color: var(--primary);
            --fc-list-event-hover-bg-color: rgba(255, 255, 255, 0.05);
            font-family: 'Inter', sans-serif;
        }

        .fc-toolbar-title {
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            letter-spacing: -0.3px;
        }

        .fc-button {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid var(--border-glass) !important;
            color: white !important;
            border-radius: 12px !important;
            padding: 10px 16px !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            box-shadow: none !important;
            transition: all 0.2s ease !important;
        }

        .fc-button:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .fc-button-active {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            box-shadow: 0 4px 15px var(--primary-glow) !important;
        }

        .fc-col-header-cell-cushion, .fc-daygrid-day-number {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 10px !important;
        }

        .fc-event {
            border-radius: 8px !important;
            padding: 5px 8px !important;
            font-size: 0.82rem !important;
            font-weight: 500 !important;
            border: none !important;
            background: linear-gradient(135deg, #ff385c, #e11d48) !important;
            box-shadow: 0 4px 12px rgba(255, 56, 92, 0.25);
            cursor: pointer;
        }

        /* =========================
            DATA TABLE MATRIX
        ========================= */
        .table-container {
            background: var(--bg-surface);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .enterprise-table {
            width: 100%;
            margin: 0;
            color: white;
            border-collapse: separate;
            border-spacing: 0;
            white-space: nowrap;
        }

        .enterprise-table th {
            background: rgba(7, 11, 22, 0.85);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-glass);
        }

        .enterprise-table td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            font-size: 0.88rem;
        }

        .enterprise-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .enterprise-table tbody tr:last-child td {
            border-bottom: none;
        }

        .enterprise-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .badge-room {
            background: linear-gradient(135deg, rgba(255, 56, 92, 0.15), rgba(225, 29, 72, 0.05));
            border: 1px solid rgba(255, 56, 92, 0.3);
            color: #ff859b;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn.view { 
            background: rgba(37, 99, 235, 0.15); 
            border-color: rgba(37, 99, 235, 0.3); 
            color: #60a5fa; 
        }
        .action-btn.view:hover { background: rgba(37, 99, 235, 0.3); color: #fff; }

        .action-btn.edit { 
            background: rgba(245, 158, 11, 0.15); 
            border-color: rgba(245, 158, 11, 0.3); 
            color: #fbbf24; 
        }
        .action-btn.edit:hover { background: rgba(245, 158, 11, 0.3); color: #fff; }

        .action-btn.delete {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
            color: #f87171;
        }
        .action-btn.delete:hover { background: rgba(239, 68, 68, 0.3); color: #fff; }

        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #38bdf8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .file-link:hover {
            color: #7dd3fc;
            text-decoration: underline;
        }

        /* Alert Styling */
        .enterprise-alert {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
            padding: 16px 20px;
            border-radius: 16px;
            font-weight: 500;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            backdrop-filter: blur(10px);
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
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

            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="bi bi-people"></i>
                <span>Client Users</span>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="nav-item">
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
        <div class="container-box">

            <!-- PAGE HEADER TITLE BAR -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-calendar-check"></i>
                    Manage Bookings Matrix
                </h1>

                <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
                    <i class="bi bi-arrow-left"></i>
                    Return to Dashboard
                </a>
            </div>

            <!-- INTERACTIVE FULLCALENDAR MATRIX (EXPANDED) -->
            <div class="calendar-wrapper">
                <div id="calendar"></div>
            </div>

            <!-- SUCCESS NOTIFICATION FEEDBACK -->
            @if(session('success'))
                <div class="enterprise-alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- DATA RECORD TABLE -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="enterprise-table">
                        <thead>
                            <tr>
                                <th># ID</th>
                                <th>Booking Code</th>
                                <th>Client Name</th>
                                <th>Email Address</th>
                                <th>Contact Number</th>
                                <th>Room Space</th>
                                <th>Guests</th>
                                <th>Event Type</th>
                                <th>Schedule Windows</th>
                                <th>Receipt Voucher</th>
                                <th>Operational Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="text-muted">#{{ $booking->id }}</td>
                                    <td><span class="font-monospace fw-bold text-danger">#{{ $booking->booking_id }}</span></td>
                                    <td class="fw-semibold">{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                    <td class="text-muted">{{ $booking->email }}</td>
                                    <td>{{ $booking->contact }}</td>
                                    <td>
                                        <span class="badge-room">
                                            {{ $booking->room_type }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $booking->guests }}</td>
                                    <td>{{ $booking->event?->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="fw-medium">{{ \Carbon\Carbon::parse($booking->booking_datetime)->format('M d, Y h:i A') }}</div>
                                        <small class="text-muted">
                                            → {{ \Carbon\Carbon::parse($booking->end_datetime)->format('M d, Y h:i A') }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($booking->receipt)
                                            <a href="{{ asset('storage/'.$booking->receipt) }}" target="_blank" class="file-link">
                                                <i class="bi bi-file-earmark-text-fill"></i> View Document
                                            </a>
                                        @else
                                            <span class="text-muted fst-italic">No Voucher</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-group">
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="action-btn view" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="action-btn edit" title="Modify Record">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete" title="Purge Record" onclick="return confirm('Are you sure you want to permanently delete this booking matrix record?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5 text-muted">
                                        <div class="py-4">
                                            <i class="bi bi-folder2-open display-4 opacity-50 mb-3 d-block"></i>
                                            <span class="fs-6">No tracking records or active bookings located within the system matrix.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- =========================
       CALENDAR INITIALIZATION SCRIPT
    ========================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '100%',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/admin/bookings/events',
                editable: false,
                selectable: false,
                eventClick: function(info) {
                    alert(
                        "Booking Allocation Details:\n\n" +
                        "• Space Unit: " + info.event.title + "\n" +
                        "• Activation: " + info.event.start.toLocaleString() + "\n" +
                        "• Termination: " + (info.event.end ? info.event.end.toLocaleString() : 'N/A')
                    );
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>