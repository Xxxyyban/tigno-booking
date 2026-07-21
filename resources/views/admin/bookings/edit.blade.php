<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Booking - Admin Dashboard</title>

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

/* Custom Scrollbar */
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
   ADMIN TOP NAVBAR
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

.edit-container {
    max-width: 900px;
    margin: 0 auto;
}

.card {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 35px;
    color: white;
    box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.45);
}

.card h2 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0;
}

.card hr {
    border-color: rgba(255, 255, 255, 0.1);
    margin: 20px 0 25px 0;
}

.form-control,
.form-select {
    background: rgba(255, 255, 255, 0.04) !important;
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 12px !important;
    padding: 12px 16px !important;
    font-size: 0.9rem !important;
    transition: all 0.3s ease !important;
}

.form-control:focus,
.form-select:focus {
    background: rgba(255, 255, 255, 0.08) !important;
    border-color: rgba(255, 56, 92, 0.5) !important;
    box-shadow: 0 0 15px rgba(255, 56, 92, 0.15) !important;
}

/* Fix dropdown options dark styling */
.form-select option {
    background: #0f172a;
    color: white;
}

.btn-save {
    background: linear-gradient(135deg, #ff385c, #e11d48);
    color: white;
    width: 100%;
    border: none;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    margin-top: 20px;
    box-shadow: 0 4px 15px rgba(255, 56, 92, 0.35);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-save:hover {
    background: linear-gradient(135deg, #e11d48, #be123c);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 56, 92, 0.5);
}

label {
    font-size: 0.8rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 6px;
    margin-top: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    .card {
        padding: 20px;
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
<a href="/admin/dashboard" class="nav-item">
<i class="bi bi-speedometer2"></i>
<span>Dashboard</span>
</a>

<a href="{{ route('bookings.index') }}" class="nav-item active">
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

<div class="edit-container">
<div class="card">

<div class="d-flex justify-content-between align-items-center">
<h2>Edit Booking</h2>
<a href="{{ route('bookings.index') }}" class="text-decoration-none text-white-50" style="font-size: 0.9rem;">
<i class="bi bi-arrow-left"></i> Back to List
</a>
</div>

<hr>

<form method="POST" action="{{ route('bookings.update', $booking->id) }}">

@csrf
@method('PUT')

<div class="row">
<div class="col-md-6">
<!-- BOOKING ID -->
<label>Booking ID</label>
<input type="text" name="booking_id"
class="form-control"
value="{{ old('booking_id', $booking->booking_id) }}" required>
</div>

<div class="col-md-6">
<!-- EVENT -->
<label>Event</label>
<select name="event_id" class="form-select" required>
@foreach($events as $event)
    <option value="{{ $event->id }}"
        {{ $booking->event_id == $event->id ? 'selected' : '' }}>
        {{ $event->name }}
    </option>
@endforeach
</select>
</div>
</div>

<div class="row">
<div class="col-md-12">
<!-- FULL NAME -->
<label>Full Name</label>
<input type="text" name="full_name"
class="form-control"
value="{{ old('full_name', $booking->full_name) }}" required>
</div>
</div>

<div class="row">
<div class="col-md-6">
<!-- EMAIL -->
<label>Email</label>
<input type="email" name="email"
class="form-control"
value="{{ old('email', $booking->email) }}" required>
</div>

<div class="col-md-6">
<!-- CONTACT -->
<label>Contact</label>
<input type="text" name="contact"
class="form-control"
value="{{ old('contact', $booking->contact) }}" required>
</div>
</div>

<div class="row">
<div class="col-md-6">
<!-- BOOKING DATE -->
<label>Check-in</label>
<input type="datetime-local" name="booking_datetime"
class="form-control"
value="{{ old('booking_datetime', $booking->booking_datetime) }}" required>
</div>

<div class="col-md-6">
<!-- CHECKOUT -->
<label>Check-out</label>
<input type="datetime-local" name="end_datetime"
class="form-control"
value="{{ old('end_datetime', $booking->end_datetime) }}">
</div>
</div>

<div class="row">
<div class="col-md-6">
<!-- GUESTS -->
<label>Guests</label>
<input type="number" name="guests"
class="form-control"
value="{{ old('guests', $booking->guests) }}" required>
</div>

<div class="col-md-6">
<!-- ROOM TYPE -->
<label>Room Type</label>
<select name="room_type" class="form-select" required>
<option value="Prince" {{ $booking->room_type == 'Prince' ? 'selected' : '' }}>Prince</option>
<option value="King" {{ $booking->room_type == 'King' ? 'selected' : '' }}>King</option>
<option value="VIP" {{ $booking->room_type == 'VIP' ? 'selected' : '' }}>VIP</option>
<option value="Elite" {{ $booking->room_type == 'Elite' ? 'selected' : '' }}>Elite</option>
</select>
</div>
</div>

<!-- NOTES -->
<label>Notes</label>
<textarea name="notes" class="form-control" rows="3">{{ old('notes', $booking->notes) }}</textarea>

<button type="submit" class="btn-save">
<i class="bi bi-check-lg me-2"></i> Update Booking
</button>

</form>

</div>
</div>

</div>

</body>
</html>