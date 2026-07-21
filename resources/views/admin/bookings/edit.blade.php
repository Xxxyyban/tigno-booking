<!DOCTYPE html>
<html>
<head>

<title>Edit Booking</title>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#0b1220;
    font-family:Segoe UI;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    color:white;
}

.card{
    width:900px;
    background:rgba(255,255,255,.05);
    backdrop-filter:blur(12px);
    border-radius:20px;
    padding:35px;
}

.form-control,
.form-select{
    background:rgba(255,255,255,.08)!important;
    color:white!important;
    border:1px solid rgba(255,255,255,.1)!important;
    margin-bottom:12px;
}

.btn-save{
    background:#ff385c;
    color:white;
    width:100%;
    border:none;
    padding:12px;
    border-radius:12px;
    margin-top:10px;
}

label{
    font-size:13px;
    margin-top:10px;
}

</style>

</head>

<body>

<div class="card">

<h2>Edit Booking</h2>

<form method="POST" action="{{ route('bookings.update', $booking->id) }}">

@csrf
@method('PUT')

<!-- BOOKING ID -->
<label>Booking ID</label>
<input type="text" name="booking_id"
class="form-control"
value="{{ old('booking_id', $booking->booking_id) }}" required>

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

<!-- FULL NAME -->
<label>Full Name</label>
<input type="text" name="full_name"
class="form-control"
value="{{ old('full_name', $booking->full_name) }}" required>

<!-- EMAIL -->
<label>Email</label>
<input type="email" name="email"
class="form-control"
value="{{ old('email', $booking->email) }}" required>

<!-- CONTACT -->
<label>Contact</label>
<input type="text" name="contact"
class="form-control"
value="{{ old('contact', $booking->contact) }}" required>

<!-- BOOKING DATE -->
<label>Check-in</label>
<input type="datetime-local" name="booking_datetime"
class="form-control"
value="{{ old('booking_datetime', $booking->booking_datetime) }}" required>

<!-- CHECKOUT -->
<label>Check-out</label>
<input type="datetime-local" name="end_datetime"
class="form-control"
value="{{ old('end_datetime', $booking->end_datetime) }}">

<!-- GUESTS -->
<label>Guests</label>
<input type="number" name="guests"
class="form-control"
value="{{ old('guests', $booking->guests) }}" required>

<!-- ROOM TYPE -->
<label>Room Type</label>
<select name="room_type" class="form-select" required>

<option value="Prince" {{ $booking->room_type == 'Prince' ? 'selected' : '' }}>Prince</option>
<option value="King" {{ $booking->room_type == 'King' ? 'selected' : '' }}>King</option>
<option value="VIP" {{ $booking->room_type == 'VIP' ? 'selected' : '' }}>VIP</option>
<option value="Elite" {{ $booking->room_type == 'Elite' ? 'selected' : '' }}>Elite</option>

</select>

<!-- NOTES -->
<label>Notes</label>
<textarea name="notes" class="form-control">{{ old('notes', $booking->notes) }}</textarea>

<button type="submit" class="btn-save">
Update Booking
</button>

</form>

</div>

</body>
</html>