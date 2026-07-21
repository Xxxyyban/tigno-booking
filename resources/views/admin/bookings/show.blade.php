<!DOCTYPE html>
<html>
<head>

    <title>Booking Details</title>

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
        }

        .card{
            width:850px;
            background:rgba(255,255,255,.05);
            backdrop-filter:blur(12px);
            border-radius:20px;
            padding:35px;
            color:white;
            box-shadow:0 25px 50px rgba(0,0,0,.35);
        }

        .row-box{
            background:rgba(255,255,255,.06);
            padding:12px;
            border-radius:10px;
            margin-bottom:12px;
        }

        strong{
            color:#ff385c;
        }

        .btn-back{
            background:#ff385c;
            color:white;
            padding:10px 20px;
            border-radius:10px;
            text-decoration:none;
        }

    </style>

</head>

<body>

<div class="card">

<h2>Booking Information</h2>

<hr>

<div class="row-box">
<strong>Booking ID</strong><br>
{{ $booking->booking_id }}
</div>

<div class="row-box">
<strong>Name</strong><br>
{{ $booking->first_name }} {{ $booking->last_name }}
</div>

<div class="row-box">
<strong>Email</strong><br>
{{ $booking->email }}
</div>

<div class="row-box">
<strong>Contact</strong><br>
{{ $booking->country_code }} {{ $booking->contact }}
</div>

<div class="row-box">
<strong>Check-in</strong><br>
{{ $booking->booking_datetime }}
</div>

<div class="row-box">
<strong>Check-out</strong><br>
{{ $booking->end_datetime }}
</div>

<div class="row-box">
<strong>Guests</strong><br>
{{ $booking->guests }}
</div>

<div class="row-box">
<strong>Room Type</strong><br>
{{ $booking->room_type }}
</div>

<div class="row-box">
<strong>Notes</strong><br>
{{ $booking->notes }}
</div>

<a href="{{ route('bookings.index') }}" class="btn-back">
← Back
</a>

</div>

</body>
</html>