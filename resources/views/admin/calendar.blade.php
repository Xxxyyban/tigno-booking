<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Calendar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>

body{
    background:#0f172a;
    color:white;
    font-family:Segoe UI;
    padding:30px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.btn-back{
    background:#2563eb;
    color:white;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
}

#calendar{
    background:white;
    color:black;
    padding:15px;
    border-radius:12px;
}

</style>

</head>

<body>

<div class="header">

<h2>📅 Booking Calendar (Admin)</h2>

<a href="{{ route('admin.dashboard') }}" class="btn-back">
← Back
</a>

</div>

<div id="calendar"></div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

        initialView: 'dayGridMonth',
        height: 700,

        // 🔥 LOAD BOOKINGS FROM DATABASE
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