<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Client Users — Admin Dashboard</title>

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
   PANELS
========================= */
.panel {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.07);
    padding: 28px;
    border-radius: 20px;
    box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.3);
}

.panel h4 {
    font-size: 1.05rem;
    font-weight: 600;
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* =========================
   TABLE STYLING
========================= */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    color: #f8fafc;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.custom-table th, 
.custom-table td {
    padding: 14px 18px;
    font-size: 0.87rem;
    text-align: left;
    white-space: nowrap;
}

.custom-table th {
    color: rgba(255, 255, 255, 0.45);
    font-weight: 500;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    background: transparent;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    padding-top: 0;
}

.custom-table tbody tr {
    background: rgba(255, 255, 255, 0.02);
    transition: all 0.25s ease;
    border: 1px solid rgba(255, 255, 255, 0.03);
}

.custom-table tbody tr td:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
    font-weight: 600;
    color: #ff859b;
}

.custom-table tbody tr td:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}

.custom-table tbody tr:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-1px);
    border-color: rgba(255, 255, 255, 0.08);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* =========================
   BUTTONS
========================= */
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

<a href="{{ route('admin.calendar') }}" class="nav-item">
<i class="bi bi-calendar3"></i>
<span>Calendar</span>
</a>

<a href="{{ route('admin.users') }}" class="nav-item active">
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
<h1>Client Users Management 👥</h1>
<p>View and manage all registered client profiles within the system.</p>
</div>

<!-- =========================
     USERS TABLE PANEL
========================= -->
<div class="panel">
<h4>
<span>Registered Users</span>
<span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-25" style="font-size: 0.75rem; padding: 6px 12px; border-radius: 20px;">
{{ \App\Models\User::count() }} Total
</span>
</h4>

<div class="table-responsive">
<table class="custom-table">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email Address</th>
<th>Registered Date</th>
</tr>
</thead>
<tbody>
@foreach(\App\Models\User::latest()->get() as $user)
<tr>
<td>#{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->created_at ? $user->created_at->format('M d, Y h:i A') : 'N/A' }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

</div>

</div>

</body>
</html>