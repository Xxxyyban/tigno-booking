<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

/* Custom Scrollbar for Glass Aesthetic */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: rgba(15, 23, 42, 0.6);
}
::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Glass Card Helper */
.glass-panel {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
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
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border-right: 1px solid rgba(255, 255, 255, 0.08);
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
    color: #fff;
    text-shadow: 0 2px 10px rgba(255, 56, 92, 0.3);
}

.sidebar-brand i {
    color: #ff385c;
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
    color: rgba(255, 255, 255, 0.65);
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
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transform: translateX(4px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.nav-item.active {
    background: linear-gradient(135deg, rgba(255, 56, 92, 0.2), rgba(225, 29, 72, 0.1));
    border-color: rgba(255, 56, 92, 0.3);
    color: #ff859b;
}

.sidebar-footer {
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.06);
}

/* =========================
   TOP NAVBAR (ADMIN)
========================= */
.admin-navbar {
    margin-left: 270px;
    height: 80px;
    padding: 0 35px;
    background: rgba(15, 23, 42, 0.45);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
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
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 10px 15px 10px 42px;
    border-radius: 12px;
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.admin-navbar-search input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 56, 92, 0.5);
    box-shadow: 0 0 15px rgba(255, 56, 92, 0.15);
}

.admin-navbar-search i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.4);
}

.admin-nav-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.icon-btn {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.8);
    position: relative;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
}

.icon-btn:hover {
    background: rgba(255, 255, 255, 0.1);
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
    border-left: 1px solid rgba(255, 255, 255, 0.1);
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
    box-shadow: 0 4px 15px rgba(255, 56, 92, 0.3);
}

.admin-info .name {
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.2;
}

.admin-info .role {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.5);
}

/* =========================
   MAIN CONTENT AREA
========================= */
.main {
    margin-left: 270px;
    padding: 35px;
}

.welcome-banner {
    margin-bottom: 30px;
}

.welcome-banner h1 {
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.welcome-banner p {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
    margin: 0;
}

/* =========================
   CARDS GRID
========================= */
.card-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 35px;
}

.card-box {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 24px;
    border-radius: 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.card-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card-box:hover {
    transform: translateY(-6px);
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.15);
    box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.45);
}

.card-box:hover::before {
    opacity: 1;
}

.card-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.card-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #ff385c;
}

.card-title {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
    font-weight: 500;
}

.card-value {
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: -0.5px;
}

/* =========================
   SECTIONS & PANELS
========================= */
.section {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 25px;
}

.panel {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
}

.panel h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* =========================
   TABLE STYLING
========================= */
.table-responsive {
    width: 100%;
}

table {
    width: 100%;
    color: white;
    border-collapse: separate;
    border-spacing: 0 8px;
}

th, td {
    padding: 14px 16px;
    font-size: 0.88rem;
    text-align: left;
}

th {
    color: rgba(255, 255, 255, 0.5);
    font-weight: 500;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: transparent;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

tr {
    background: rgba(255, 255, 255, 0.02);
    transition: all 0.2s ease;
}

tr td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

tr td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

tr:hover {
    background: rgba(255, 255, 255, 0.06);
    transform: scale(1.002);
}

/* =========================
   BUTTONS
========================= */
.btn-modern {
    background: linear-gradient(135deg, #ff385c, #e11d48);
    border: none;
    padding: 12px 18px;
    border-radius: 12px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    display: inline-block;
    text-align: center;
    box-shadow: 0 4px 15px rgba(255, 56, 92, 0.35);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-modern:hover {
    background: linear-gradient(135deg, #e11d48, #be123c);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 56, 92, 0.5);
}

.logout {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.15);
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
    background: rgba(255, 56, 92, 0.15);
    border-color: rgba(255, 56, 92, 0.3);
    color: #ff859b;
}

/* Responsive tweaks */
@media(max-width: 1200px) {
    .card-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .section {
        grid-template-columns: 1fr;
    }
}

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
    .card-grid {
        grid-template-columns: 1fr;
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

</div>

<!-- =========================
     MAIN CONTENT
========================= -->
<div class="main">

<div class="welcome-banner">
<h1>Welcome Back, Admin 👋</h1>
<p>Here is what's happening with your property bookings today.</p>
</div>

<!-- =========================
     STATS CARDS
========================= -->
<div class="card-grid">

<div class="card-box">
<div class="card-header-flex">
<div class="card-title">Total Bookings</div>
<div class="card-icon"><i class="bi bi-journal-bookmark"></i></div>
</div>
<div class="card-value">{{ \App\Models\Booking::count() }}</div>
</div>

<div class="card-box">
<div class="card-header-flex">
<div class="card-title">Active Rooms</div>
<div class="card-icon"><i class="bi bi-door-open"></i></div>
</div>
<div class="card-value">12</div>
</div>

<div class="card-box">
<div class="card-header-flex">
<div class="card-title">Today Bookings</div>
<div class="card-icon"><i class="bi bi-calendar-day"></i></div>
</div>
<div class="card-value">5</div>
</div>

<div class="card-box">
<div class="card-header-flex">
<div class="card-title">Revenue</div>
<div class="card-icon"><i class="bi bi-wallet2"></i></div>
</div>
<div class="card-value">₱25,000</div>
</div>

</div>

<!-- =========================
     MAIN SECTIONS
========================= -->
<div class="section">

<!-- RECENT BOOKINGS -->
<div class="panel">
<h4>
<span>Recent Bookings</span>
<a href="{{ route('bookings.index') }}" class="text-decoration-none" style="font-size: 0.8rem; color: #ff385c;">View All</a>
</h4>

<div class="table-responsive">
<table>
<thead>
<tr>
<th>ID</th>
<th>Customer</th>
<th>Room</th>
<th>Date</th>
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

<!-- QUICK ACTIONS -->
<div class="panel">
<h4>Quick Actions</h4>

<div class="d-flex flex-column gap-2 mt-3">
<a href="{{ route('bookings.index') }}" class="btn-modern">
<i class="bi bi-calendar-check me-2"></i> Manage Bookings
</a>

<a href="{{ route('admin.calendar') }}" class="btn-modern">
<i class="bi bi-calendar3 me-2"></i> View Calendar
</a>

<a href="#" class="btn-modern">
<i class="bi bi-plus-circle me-2"></i> Add Room
</a>
</div>

</div>

</div>

</div>

</body>
</html>