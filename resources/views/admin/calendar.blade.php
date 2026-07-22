<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Booking Calendar - Admin Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- FULLCALENDAR -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>

/* =========================
   GLOBAL & GLASSMORPHISM VIBE
========================= */
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top left, #1e1b4b, #0f172a, #090d16);
    background-attachment: fixed;
    color: #f8fafc;
    min-height: 100vh;
    overflow-x: hidden;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: rgba(15, 23, 42, 0.8);
}
::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.4);
}

/* =========================
   SIDEBAR
========================= */
.sidebar {
    width: 270px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(11, 17, 32, 0.9);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    padding: 25px;
    z-index: 1040;
    display: flex;
    flex-direction: column;
}

.sidebar-brand {
    font-size: 1.15rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 35px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ffffff;
    text-shadow: 0 2px 10px rgba(255, 56, 92, 0.3);
}

.sidebar-brand i {
    color: #ff859b;
    font-size: 1.4rem;
}

.nav-menu {
    flex-grow: 1;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    margin-bottom: 8px;
    border-radius: 12px;
    color: rgba(255, 255, 255, 0.75);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-item i {
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.nav-item:hover, .nav-item.active {
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.08);
    transform: translateX(4px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.nav-item.active {
    background: linear-gradient(135deg, rgba(255, 56, 92, 0.3), rgba(225, 29, 72, 0.2));
    border-color: rgba(255, 56, 92, 0.4);
    color: #ff859b;
}

.sidebar-footer {
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* =========================
   ADMIN TOP NAVBAR
========================= */
.admin-navbar {
    margin-left: 270px;
    height: 80px;
    padding: 0 35px;
    background: rgba(11, 17, 32, 0.85);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 1030;
}

.admin-navbar-search {
    position: relative;
    width: 340px;
}

.admin-navbar-search input {
    width: 100%;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 10px 15px 10px 42px;
    border-radius: 12px;
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.admin-navbar-search input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.admin-navbar-search input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 56, 92, 0.6);
    box-shadow: 0 0 15px rgba(255, 56, 92, 0.2);
}

.admin-navbar-search i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.6);
}

.admin-nav-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.icon-btn {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.12);
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.9);
    position: relative;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
}

.icon-btn:hover {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    transform: translateY(-2px);
}

.icon-btn .badge-dot {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 8px;
    height: 8px;
    background: #ff385c;
    border-radius: 50%;
    box-shadow: 0 0 8px #ff385c;
}

.admin-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-left: 15px;
    border-left: 1px solid rgba(255, 255, 255, 0.15);
}

.admin-avatar {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, #ff385c, #9333ea);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.95rem;
    color: #fff;
    box-shadow: 0 4px 15px rgba(255, 56, 92, 0.4);
}

.admin-info .name {
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.2;
    color: #ffffff;
}

.admin-info .role {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
}

/* =========================
   MAIN CONTENT AREA
========================= */
.main {
    margin-left: 270px;
    padding: 35px;
}

.container-box {
    max-width: 1400px;
    margin: auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ffffff;
}

.btn-dashboard {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-dashboard:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
}

/* =========================
   CALENDAR BOX (GLASS)
========================= */
#calendar {
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.45);
}

/* FullCalendar Dark Customization overrides */
.fc {
    --fc-page-bg-color: transparent;
    --fc-neutral-bg-color: rgba(255, 255, 255, 0.04);
    --fc-neutral-border-color: rgba(255, 255, 255, 0.1);
    --fc-border-color: rgba(255, 255, 255, 0.1);
    --fc-today-bg-color: rgba(255, 56, 92, 0.15);
    --fc-event-bg-color: #ff385c;
    --fc-event-border-color: #ff385c;
    --fc-list-event-hover-bg-color: rgba(255, 255, 255, 0.08);
    color: white;
}

.fc-toolbar-title {
    font-size: 1.15rem !important;
    font-weight: 600;
    color: #ffffff;
}

.fc-button {
    background: rgba(255, 255, 255, 0.08) !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    color: white !important;
    border-radius: 10px !important;
    padding: 8px 14px !important;
    font-weight: 500 !important;
    box-shadow: none !important;
    transition: all 0.2s ease !important;
}

.fc-button:hover {
    background: rgba(255, 255, 255, 0.15) !important;
    border-color: rgba(255, 255, 255, 0.25) !important;
}

.fc-button-active {
    background: #ff385c !important;
    border-color: #ff385c !important;
    color: #ffffff !important;
}

.fc-col-header-cell-cushion, .fc-daygrid-day-number {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    font-weight: 500;
}

.logout {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
}

.logout:hover {
    background: rgba(255, 56, 92, 0.2);
    border-color: rgba(255, 56, 92, 0.4);
    color: #ff859b;
}

/* Responsive tweaks */
@media(max-width: 768px) {
    .sidebar {
        width: 70px;
        padding: 15px 10px;
    }
    .sidebar-brand span, .nav-item span {
        display: none;
    }
    .admin-navbar, .main {
        margin-left: 70px;
    }
    .admin-navbar {
        padding: 0 15px;
    }
    .admin-navbar-search {
        display: none;
    }
}

</style>

</head>

<body>

<!-- =========================
     SIDEBAR
========================= -->
<div class="sidebar">

<div class="sidebar-brand">
<i class="bi bi-lightning-charge-fill"></i>
<span>Admin Panel</span>
</div>

<div class="nav-menu">
<a href="{{ route('admin.dashboard') }}" class="nav-item">
<i class="bi bi-speedometer2"></i>
<span>Dashboard</span>
</a>

<a href="{{ route('admin.bookings.index') }}" class="nav-item">
<i class="bi bi-calendar-check"></i>
<span>Bookings</span>
</a>

<a href="{{ route('admin.calendar') }}" class="nav-item active">
<i class="bi bi-calendar3"></i>
<span>Calendar</span>
</a>

<a href="{{ route('admin.users') }}" class="nav-item">
<i class="bi bi-people"></i>
<span>Users</span>
</a>
</div>

<div class="sidebar-footer">
<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="logout">
<i class="bi bi-box-arrow-right"></i>
<span>Logout</span>
</button>
</form>
</div>

</div>

<!-- =========================
     ADMIN TOP NAVBAR
========================= -->
<div class="admin-navbar">

<div class="admin-navbar-search">
<i class="bi bi-search"></i>
<input type="text" placeholder="Search bookings, users, rooms...">
</div>

<div class="admin-nav-actions">
<a href="#" class="icon-btn" title="Notifications">
<i class="bi bi-bell"></i>
<span class="badge-dot"></span>
</a>

<div class="admin-profile">
<div class="admin-avatar">AD</div>
<div class="admin-info d-none d-md-block">
<div class="name">Administrator</div>
<div class="role">System Manager</div>
</div>
</div>
</div>

</div>

<!-- =========================
     MAIN CONTENT
========================= -->
<div class="main">

<div class="container-box">

    <!-- HEADER -->
    <div class="header">

        <h2>
            <i class="bi bi-calendar3" style="color: #ff859b;"></i>
            Booking Calendar (Admin)
        </h2>

        <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

    </div>

    <!-- CALENDAR BOX -->
    <div id="calendar"></div>

</div>

</div>

<!-- =========================
     CALENDAR SCRIPT
========================== -->
<script>

document.addEventListener('DOMContentLoaded', function () {

    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

        initialView: 'dayGridMonth',

        height: 700,

        events: '/admin/bookings/events',

        eventColor: '#ff385c',

        editable: false,

        selectable: false,

        eventClick: function(info) {
            alert(
                "Room: " + info.event.title + "\n" +
                "Start: " + info.event.start.toLocaleString() + "\n" +
                "End: " + info.event.end.toLocaleString()
            );
        }

    });

    calendar.render();

});

</script>

</body>
</html>