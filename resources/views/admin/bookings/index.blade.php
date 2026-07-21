<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Bookings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FULLCALENDAR -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <style>

        body{
            background:#0f172a;
            color:white;
            font-family:'Segoe UI',sans-serif;
            margin:0;
            padding:40px;
        }

        .container-box{
            max-width:1400px;
            margin:auto;
        }

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .btn-dashboard{
            background:#2563eb;
            color:white;
            text-decoration:none;
            padding:10px 18px;
            border-radius:10px;
        }

        /* CALENDAR BOX */
        #calendar {
            background:white;
            color:black;
            padding:15px;
            border-radius:12px;
            margin-bottom:30px;
        }

        .table-box{
            background:rgba(255,255,255,.05);
            backdrop-filter:blur(10px);
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 20px 50px rgba(0,0,0,.4);
        }

        table{
            width:100%;
            margin:0;
        }

        th{
            background:#111827;
            color:white;
            font-weight:600;
            padding:15px;
        }

        td{
            padding:15px;
            vertical-align:middle;
            border-bottom:1px solid rgba(255,255,255,.08);
        }

        tr:hover{
            background:rgba(255,255,255,.03);
        }

        .badge-room{
            background:#ff385c;
            padding:6px 12px;
            border-radius:30px;
            font-size:12px;
        }

        .action-btn{
            padding:7px 12px;
            border-radius:8px;
            text-decoration:none;
            color:white;
            margin-right:5px;
        }

        .view{ background:#2563eb; }
        .edit{ background:#f59e0b; }

        .delete{
            background:#dc2626;
            border:none;
            padding:7px 12px;
            border-radius:8px;
            color:white;
        }

        form{ display:inline; }

    </style>

</head>

<body>

<div class="container-box">

    <!-- HEADER -->
    <div class="header">

        <h2>
            <i class="bi bi-calendar-check"></i>
            Admin Booking System
        </h2>

        <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

    </div>

    <!-- =========================
         CALENDAR (NEW ADDITION)
    ========================== -->
    <div id="calendar"></div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="table-box">

        <table class="table table-dark table-hover align-middle mb-0">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Room</th>
                    <th>Guests</th>
                    <th>Event</th>
                    <th>Schedule</th>
                    <th>Receipt</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($bookings as $booking)

                <tr>

                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->booking_id }}</td>

                    <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->contact }}</td>

                    <td>
                        <span class="badge-room">
                            {{ $booking->room_type }}
                        </span>
                    </td>

                    <td>{{ $booking->guests }}</td>

                    <td>{{ $booking->event?->name ?? 'N/A' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($booking->booking_datetime)->format('M d, Y h:i A') }}
                        <br>
                        <small>
                            → {{ \Carbon\Carbon::parse($booking->end_datetime)->format('M d, Y h:i A') }}
                        </small>
                    </td>

                    <td>
                        @if($booking->receipt)
                            <a href="{{ asset('storage/'.$booking->receipt) }}" target="_blank">
                                View File
                            </a>
                        @else
                            No File
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('bookings.show',$booking->id) }}" class="action-btn view">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('bookings.edit',$booking->id) }}" class="action-btn edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form method="POST" action="{{ route('bookings.destroy',$booking->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="delete" onclick="return confirm('Delete this booking?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="11" class="text-center p-5">
                        No bookings found.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- =========================
     CALENDAR SCRIPT
========================== -->
<script>

document.addEventListener('DOMContentLoaded', function () {

    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

        initialView: 'dayGridMonth',

        height: 500,

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