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

<style>

/* =========================
   GLOBAL
========================= */
body{
    margin:0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f172a, #111827);
    color:white;
}

/* =========================
   SIDEBAR
========================= */
.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(20px);
    border-right: 1px solid rgba(255,255,255,0.1);
    padding:25px;
}

.sidebar h2{
    font-size:18px;
    margin-bottom:30px;
}

.nav-item{
    display:block;
    padding:12px;
    margin-bottom:10px;
    border-radius:10px;
    color:rgba(255,255,255,0.7);
    text-decoration:none;
    transition:0.2s;
}

.nav-item:hover{
    background:rgba(255,255,255,0.1);
    color:white;
    transform:translateX(5px);
}

/* =========================
   MAIN CONTENT
========================= */
.main{
    margin-left:260px;
    padding:30px;
}

/* =========================
   TOP BAR
========================= */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.search-box{
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.1);
    padding:10px;
    border-radius:10px;
    width:300px;
    color:white;
}

/* =========================
   CARDS
========================= */
.card-grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:20px;
}

.card-box{
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.1);
    padding:20px;
    border-radius:15px;
    transition:0.2s;
}

.card-box:hover{
    transform:translateY(-5px);
    background:rgba(255,255,255,0.08);
}

.card-title{
    font-size:14px;
    opacity:0.7;
}

.card-value{
    font-size:26px;
    font-weight:bold;
}

/* =========================
   BUTTONS
========================= */
.btn-modern{
    background:#ff385c;
    border:none;
    padding:10px 15px;
    border-radius:10px;
    color:white;
    text-decoration:none;
    transition:0.2s;
}

.btn-modern:hover{
    background:#e11d48;
    transform:scale(1.03);
}

/* =========================
   SECTIONS
========================= */
.section{
    margin-top:30px;
    display:grid;
    grid-template-columns: 2fr 1fr;
    gap:20px;
}

.panel{
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.1);
    padding:20px;
    border-radius:15px;
}

/* =========================
   TABLE
========================= */
table{
    width:100%;
    color:white;
}

th, td{
    padding:10px;
    font-size:13px;
}

th{
    opacity:0.7;
}

tr:hover{
    background:rgba(255,255,255,0.05);
}

.logout{
    background:transparent;
    border:1px solid rgba(255,255,255,0.3);
    color:white;
    padding:10px 15px;
    border-radius:10px;
}

.logout:hover{
    background:white;
    color:black;
}

</style>

</head>

<body>

<!-- =========================
     SIDEBAR
========================= -->
<div class="sidebar">

<h2>⚡ Admin Panel</h2>

<a href="/admin/dashboard" class="nav-item">
<i class="bi bi-speedometer2"></i> Dashboard
</a>

<a href="{{ route('bookings.index') }}" class="nav-item">
<i class="bi bi-calendar-check"></i> Bookings
</a>

<a href="{{ route('admin.calendar') }}" class="nav-item">
<i class="bi bi-calendar3"></i> Calendar
</a>

<a href="#" class="nav-item">
<i class="bi bi-people"></i> Users
</a>

<a href="#" class="nav-item">
<i class="bi bi-gear"></i> Settings
</a>

</div>

<!-- =========================
     MAIN CONTENT
========================= -->
<div class="main">

<!-- TOP BAR -->
<div class="topbar">

<h2>Welcome Admin 👋</h2>

<div>
<input class="search-box" placeholder="Search bookings...">
</div>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="logout">Logout</button>
</form>

</div>

<!-- =========================
     STATS CARDS
========================= -->
<div class="card-grid">

<div class="card-box">
<div class="card-title">Total Bookings</div>
<div class="card-value">{{ \App\Models\Booking::count() }}</div>
</div>

<div class="card-box">
<div class="card-title">Active Rooms</div>
<div class="card-value">12</div>
</div>

<div class="card-box">
<div class="card-title">Today Bookings</div>
<div class="card-value">5</div>
</div>

<div class="card-box">
<div class="card-title">Revenue</div>
<div class="card-value">₱25,000</div>
</div>

</div>

<!-- =========================
     MAIN SECTIONS
========================= -->
<div class="section">

<!-- RECENT BOOKINGS -->
<div class="panel">

<h4>Recent Bookings</h4>

<table>

<tr>
<th>ID</th>
<th>Customer</th>
<th>Room</th>
<th>Date</th>
</tr>

@foreach(\App\Models\Booking::latest()->take(5)->get() as $b)

<tr>
<td>{{ $b->booking_id }}</td>
<td>{{ $b->first_name }}</td>
<td>{{ $b->room_type }}</td>
<td>{{ $b->booking_datetime }}</td>
</tr>

@endforeach

</table>

</div>

<!-- QUICK ACTIONS -->
<div class="panel">

<h4>Quick Actions</h4>

<br>

<a href="{{ route('bookings.index') }}" class="btn-modern d-block mb-2">
Manage Bookings
</a>

<a href="{{ route('admin.calendar') }}" class="btn-modern d-block mb-2">
View Calendar
</a>

<a href="#" class="btn-modern d-block mb-2">
Add Room
</a>

</div>

</div>

</div>

</body>
</html>