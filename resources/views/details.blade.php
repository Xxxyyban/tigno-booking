<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details | TignoBooking</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ff385c;
            --primary-dark: #e61e4d;
            --secondary: #3b82f6;
            --success: #22c55e;
            --warning: #f59e0b;
            --glass: rgba(255, 255, 255, .08);
            --glass-border: rgba(255, 255, 255, .15);
            --text: #ffffff;
            --muted: #b8bfd1;
            --radius: 28px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #070b16;
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
            position: relative;
            padding: 70px 25px;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, .45), transparent 35%),
                radial-gradient(circle at 90% 20%, rgba(255, 56, 92, .40), transparent 35%),
                radial-gradient(circle at 50% 100%, rgba(34, 197, 94, .28), transparent 45%),
                radial-gradient(circle at 30% 70%, rgba(147, 51, 234, .30), transparent 35%);
            animation: aurora 18s linear infinite alternate;
            z-index: -3;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .03), transparent, rgba(255, 255, 255, .02));
            backdrop-filter: blur(40px);
            z-index: -2;
        }

        @keyframes aurora {
            0% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.2) rotate(8deg); }
            100% { transform: scale(1.1) rotate(-6deg); }
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .35;
            animation: floatBlob 12s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }
        .blob.one { width: 300px; height: 300px; background: #ff385c; left: -80px; top: 80px; }
        .blob.two { width: 260px; height: 260px; background: #3b82f6; right: -80px; top: 120px; animation-delay: 3s; }
        .blob.three { width: 240px; height: 240px; background: #22c55e; bottom: -60px; left: 40%; animation-delay: 5s; }

        @keyframes floatBlob {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-35px) scale(1.15); }
        }

        .booking-container {
            max-width: 1450px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 450px;
            gap: 35px;
            position: relative;
            z-index: 5;
        }

        .panel {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(25px);
            border-radius: var(--radius);
            box-shadow: 0 25px 60px rgba(0, 0, 0, .35), inset 0 1px rgba(255, 255, 255, .08);
            padding: 40px;
            transition: .35s ease;
        }
        .panel:hover {
            transform: translateY(-5px);
        }

        .title {
            font-size: 45px;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(90deg, #ffffff, #ff385c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .desc {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.6;
        }

        .badge-premium {
            padding: 10px 18px;
            border-radius: 30px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .15);
            font-size: 13px;
            color: white;
            display: inline-block;
        }

        .calendar-box {
            margin-top: 35px;
            padding: 25px;
            background: rgba(0, 0, 0, .25);
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, .08);
        }

        .schedule-box {
            margin-top: 30px;
            padding: 25px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .1);
        }
        .schedule-box h5 { font-weight: 700; }

        label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control, .form-select, textarea {
            background: rgba(7, 11, 22, 0.65) !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, .15) !important;
            border-radius: 18px !important;
            height: 54px;
            padding: 12px 20px;
            transition: .3s ease;
        }
        textarea { height: auto !important; }
        .form-control::placeholder { color: rgba(255,255,255,0.35); }
        .form-control:focus, .form-select:focus, textarea:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(255, 56, 92, .25) !important;
        }
        .form-select option { background: #070b16; color: white; }

        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        .premium-btn {
            width: 100%;
            border: none;
            padding: 15px 20px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 700;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: .35s ease;
            color: white;
        }
        .premium-btn:hover {
            transform: translateY(-4px) scale(1.02);
        }
        .premium-btn.primary {
            background: linear-gradient(135deg, #ff385c, #e11d48);
            box-shadow: 0 15px 30px rgba(255, 56, 92, 0.3);
        }
        .premium-btn.primary:hover {
            box-shadow: 0 20px 40px rgba(255, 56, 92, 0.45);
        }

        .preview {
            margin-top: 25px;
            padding: 20px;
            border-radius: 20px;
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .1);
        }
        .preview small { color: var(--muted); text-transform: uppercase; font-weight: 600; font-size: 11px; }
        .preview span { color: var(--primary); font-weight: 700; }

        .user-card {
            padding: 20px;
            background: rgba(255, 255, 255, .06);
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, .1);
            margin: 25px 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-card i { font-size: 36px; color: var(--primary); }
        .user-card b { font-size: 16px; display: block; }
        .user-card small { color: var(--muted); }

        #calendar {
            background: rgba(7, 11, 22, 0.45);
            color: white;
            padding: 20px;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .fc .fc-toolbar-title { font-weight: 800!important; color: white; font-size: 1.25rem!important; }
        .fc .fc-button-primary { background: linear-gradient(135deg, #3b82f6, #2563eb)!important; border: none!important; border-radius: 10px!important; padding: 6px 14px!important; font-weight: 600!important; }
        .fc .fc-button-primary:hover { background: #2563eb!important; transform: translateY(-1px); }
        .fc .fc-button-primary:disabled { background: rgba(255,255,255,0.1)!important; color: rgba(255,255,255,0.3)!important; }
        .fc-theme-standard td, .fc-theme-standard th { border: 1px solid rgba(255,255,255,0.08)!important; }
        .fc .fc-daygrid-day-number { font-weight: 700; color: white; padding: 8px; text-decoration: none; }
        .fc .fc-daygrid-day.fc-day-today { background: rgba(255, 56, 92, 0.15)!important; }
        .fc .fc-col-header-cell-cushion { color: var(--muted); font-weight: 600; font-size: 13px; padding: 8px 0; text-decoration: none; }
        .fc-daygrid-day:hover { background: rgba(255,255,255,0.05); cursor: pointer; }
        .fc-highlight { background: rgba(59, 130, 246, 0.3)!important; }

        /* FullCalendar Event Event Pill Custom Styling */
        .fc-event {
            background: linear-gradient(135deg, #ff385c, #e11d48) !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 2px 6px !important;
            cursor: pointer !important;
            transition: transform 0.2s ease;
        }
        .fc-event:hover {
            transform: scale(1.03);
        }
        .fc-event-title {
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
        }

        .premium-toast {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px);
            background: rgba(20, 20, 30, .85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, .2);
            padding: 15px 25px; border-radius: 50px; color: white; font-weight: 600; display: flex;
            align-items: center; gap: 10px; z-index: 9999; transition: .5s; box-shadow: 0 20px 50px rgba(0, 0, 0, .4);
        }
        .premium-toast i { color: var(--success); font-size: 20px; }
        .premium-toast.show { transform: translateX(-50%) translateY(0); }

        @media(max-width: 1000px) {
            body { padding: 35px 15px; }
            .booking-container { grid-template-columns: 1fr; gap: 25px; }
            .title { font-size: 35px; }
            .panel { padding: 25px!important; border-radius: 22px; }
        }
    </style>
</head>
<body>
     <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid p-0">
            <!-- Brand Logo -->
            <a class="navbar-brand text-white text-decoration-none fw-bold fs-4" href="{{ route('welcome') }}">
                <i class="bi bi-layers-half me-1"></i> Tigno
            </a>
            
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#tignoNavbar" aria-controls="tignoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="tignoNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                </ul>
            </div>
        </div>
    </nav>

    <div class="blob one"></div>
    <div class="blob two"></div>
    <div class="blob three"></div>

    <div class="booking-container">

        <!-- LEFT PANEL: DATE/TIME SETTINGS -->
        <div class="panel">
            <span class="badge-premium">
                <i class="bi bi-calendar-check me-1 text-primary"></i> Select Booking Duration
            </span>

            <h1 class="title mt-4 mb-2">Reserve Your Event</h1>
            <p class="desc">Choose your event execution timeline by selecting your start and end targets on the calendar block.</p>

            <div class="calendar-box">
                <div id="calendar"></div>
            </div>

            <div class="schedule-box">
                <h5 class="mb-4"><i class="bi bi-clock-history text-primary me-2"></i>Schedule Time Configuration</h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="start_time">Start Time</label>
                        <input type="time" id="start_time" class="form-control" onchange="syncTimeInputs()">
                    </div>
                    <div class="col-md-6">
                        <label for="end_time">End Time</label>
                        <input type="time" id="end_time" class="form-control" onchange="syncTimeInputs()">
                    </div>
                </div>

                <button type="button" class="premium-btn primary mt-4" onclick="applySchedule()">
                    <i class="bi bi-check-circle"></i> Confirm Schedule Period
                </button>

                <div class="preview">
                    <h6 class="fw-bold mb-3"><i class="bi bi-calendar-event me-2 text-primary"></i>Selected Window Preview</h6>
                    <div class="row text-start">
                        <div class="col">
                            <small class="d-block mb-1">Timeline Start</small>
                            <p class="mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-play-circle text-success"></i>
                                <span id="previewStart">Not Selected</span>
                            </p>
                        </div>
                        <div class="col">
                            <small class="d-block mb-1">Timeline End</small>
                            <p class="mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-stop-circle text-danger"></i>
                                <span id="previewEnd">Not Selected</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL: REGISTRATION & CHECKOUT -->
        <div class="panel">
            <h3 class="fw-bold mb-2"><i class="bi bi-house-heart text-primary me-2"></i>Booking Information</h3>
            <p class="text-muted small">Verify your client credentials and supply the accommodation specification matrix below.</p>

            <div class="user-card">
                <i class="bi bi-person-circle"></i>
                <div>
                    <b>{{ $user->name }}</b>
                    <small>{{ $user->email }}</small>
                </div>
            </div>

            <form action="{{ route('booking.details.store') }}" method="POST" class="mt-4" onsubmit="return validateFormBeforeSubmit()">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger" style="background: rgba(255, 56, 92, 0.2); border: 1px solid var(--primary); color: white; border-radius: 15px; padding: 15px; margin-bottom: 20px;">
                        <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Form Validation Failed:</h6>
                        <ul class="mb-0 small" style="padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="hidden" name="booking_datetime" id="booking_datetime" value="{{ old('booking_datetime') }}">
                <input type="hidden" name="end_datetime" id="end_datetime" value="{{ old('end_datetime') }}">

                <div class="mb-3">
                    <label>Booking Reference Token</label>
                    <input class="form-control" name="booking_id" value="{{ old('booking_id', 'BK-'.rand(1000,9999)) }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Contact Number Connection</label>
                    <input class="form-control" name="contact" value="{{ old('contact') }}" placeholder="09123456789" required>
                </div>

                <div class="mb-3">
                    <label>Total Allotted Visitors</label>
                    <select name="guests" class="form-select">
                        @for($i=1;$i<=10;$i++)
                            <option value="{{$i}}" {{ old('guests') == $i ? 'selected' : '' }}>{{$i}} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label>Room Category Designation</label>
                    <select name="room_type" class="form-select" required>
                        <option value="">Select Target Room</option>
                        <option {{ old('room_type') == 'Prince Room' ? 'selected' : '' }}>Prince Room</option>
                        <option {{ old('room_type') == 'King Room' ? 'selected' : '' }}>King Room</option>
                        <option {{ old('room_type') == 'VIP Room' ? 'selected' : '' }}>VIP Room</option>
                        <option {{ old('room_type') == 'Elite Room' ? 'selected' : '' }}>Elite Room</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Linked Operational Event</label>
                    <select name="event_id" class="form-select" required>
                        <option value="">Choose Targeted Event</option>
                        @foreach($events as $event)
                            <option value="{{$event->id}}" {{ old('event_id') == $event->id ? 'selected' : '' }}>{{$event->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Special Requests & Accommodations</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="Mention structural requirements, adjustments...">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="premium-btn primary">
                    <i class="bi bi-arrow-right-circle"></i> Proceed to Checkout
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript block with improved date range handling, dynamic UI updates, and synchronization -->
    <script>
        let startDate = null;
        let endDate = null;
        let calendarInstance = null;

        document.addEventListener('DOMContentLoaded', function() {
            let today = new Date();
            today.setHours(0,0,0,0);

            // Populate events dynamically from database query ($events variable)
            let formattedEvents = [
                @foreach($events as $event)
                {
                    id: "{{ $event->id }}",
                    title: "{{ addslashes($event->name) }}",
                    start: "{{ \Carbon\Carbon::parse($event->start_date)->toIso8601String() }}",
                    end: "{{ \Carbon\Carbon::parse($event->end_date)->toIso8601String() }}",
                },
                @endforeach
            ];

            let calendarEl = document.getElementById('calendar');
            calendarInstance = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 410,
                selectable: true,
                unselectAuto: false,
                headerToolbar: { left: 'prev,next', center: 'title', right: 'today' },
                
                // Pass formatted events into FullCalendar
                events: formattedEvents,

                // Sync clicked event directly into the form select input
                eventClick: function(info) {
                    let selectElement = document.querySelector('select[name="event_id"]');
                    if (selectElement) {
                        selectElement.value = info.event.id;
                        showToast("Linked Event Selected: " + info.event.title);
                    }
                },

                dateClick: function(info) {
                    let clickedDate = new Date(info.dateStr + "T00:00:00");
                    
                    if (clickedDate < today) {
                        showToast("Historical calendar tracking periods are restricted.");
                        return;
                    }

                    if (!startDate || (startDate && endDate)) {
                        startDate = info.dateStr;
                        endDate = null;
                        showToast("Event Start: " + formatDate(startDate));
                    } else if (startDate && !endDate) {
                        let startValidation = new Date(startDate + "T00:00:00");
                        if (clickedDate < startValidation) {
                            startDate = info.dateStr;
                            endDate = null;
                            showToast("Reset Start: " + formatDate(startDate));
                        } else {
                            endDate = info.dateStr;
                            showToast("Event End: " + formatDate(endDate));
                        }
                    }

                    highlightSelectedRange();
                    updatePreview();
                }
            });
            calendarInstance.render();

            // Check if old values exist on page load (e.g. after validation error)
            let oldStart = document.getElementById('booking_datetime').value;
            let oldEnd = document.getElementById('end_datetime').value;
            if (oldStart) {
                let parts = oldStart.split(' ');
                startDate = parts[0];
                if (parts[1]) {
                    document.getElementById('start_time').value = parts[1].substring(0, 5);
                }
            }
            if (oldEnd) {
                let parts = oldEnd.split(' ');
                endDate = parts[0];
                if (parts[1]) {
                    document.getElementById('end_time').value = parts[1].substring(0, 5);
                }
            }
            if (startDate || endDate) {
                highlightSelectedRange();
                updatePreview();
            }
        });

        function highlightSelectedRange() {
            if (!calendarInstance) return;
            
            // Remove existing custom highlights or select range styling if any
            let dayEls = document.querySelectorAll('.fc-daygrid-day');
            dayEls.forEach(el => {
                el.style.backgroundColor = '';
            });

            if (startDate && endDate) {
                let current = new Date(startDate);
                let last = new Date(endDate);
                while (current <= last) {
                    let dateStr = current.toISOString().split('T')[0];
                    let dayEl = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
                    if (dayEl) {
                        dayEl.style.backgroundColor = 'rgba(59, 130, 246, 0.25)';
                    }
                    current.setDate(current.getDate() + 1);
                }
            } else if (startDate) {
                let dayEl = document.querySelector(`.fc-daygrid-day[data-date="${startDate}"]`);
                if (dayEl) {
                    dayEl.style.backgroundColor = 'rgba(255, 56, 92, 0.25)';
                }
            }
        }

        function syncTimeInputs() {
            if (startDate) {
                let startTime = document.getElementById('start_time').value;
                if (startTime) {
                    document.getElementById('booking_datetime').value = startDate + " " + startTime + ":00";
                }
            }
            if (endDate) {
                let endTime = document.getElementById('end_time').value;
                if (endTime) {
                    document.getElementById('end_datetime').value = endDate + " " + endTime + ":00";
                }
            }
            updatePreview();
        }

        function applySchedule() {
            let startTime = document.getElementById('start_time').value;
            let endTime = document.getElementById('end_time').value;

            if (!startDate || !endDate) {
                showToast("Please designate structural start and end dates.");
                return;
            }
            if (!startTime || !endTime) {
                showToast("Complete configuration parameters via allocating daily hours.");
                return;
            }

            let start = startDate + "T" + startTime + ":00";
            let end = endDate + "T" + endTime + ":00";

            let startObj = new Date(start);
            let endObj = new Date(end);

            if (endObj <= startObj) {
                showToast("End operational periods must succeed chosen initialization timestamps.");
                return;
            }

            document.getElementById('booking_datetime').value = startDate + " " + startTime + ":00";
            document.getElementById('end_datetime').value = endDate + " " + endTime + ":00";
            
            updatePreview();
            showToast("Operational parameters verified successfully.");
        }

        function validateFormBeforeSubmit() {
            let startTimestamp = document.getElementById('booking_datetime').value;
            let endTimestamp = document.getElementById('end_datetime').value;

            if (!startTimestamp || !endTimestamp) {
                showToast("Please select your schedule metrics and click 'Confirm Schedule Period' first!");
                document.querySelector('.schedule-box').scrollIntoView({ behavior: 'smooth' });
                return false;
            }
            return true;
        }

        function updatePreview() {
            if (startDate) {
                let startTime = document.getElementById('start_time').value || "";
                document.getElementById('previewStart').innerHTML = formatDate(startDate) + (startTime ? ` @ ${startTime}` : "");
            }
            if (endDate) {
                let endTime = document.getElementById('end_time').value || "";
                document.getElementById('previewEnd').innerHTML = formatDate(endDate) + (endTime ? ` @ ${endTime}` : "");
            } else {
                document.getElementById('previewEnd').innerHTML = "Not Selected";
            }
        }

        function formatDate(dateStr) {
            let d = new Date(dateStr + "T00:00:00");
            return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        }

        function showToast(message) {
            let existingToast = document.querySelector(".premium-toast");
            if (existingToast) existingToast.remove();

            let toast = document.createElement("div");
            toast.className = "premium-toast";
            toast.innerHTML = `<i class="bi bi-info-circle-fill"></i> ${message}`;
            document.body.appendChild(toast);

            setTimeout(() => { toast.classList.add("show"); }, 50);
            setTimeout(() => {
                toast.classList.remove("show");
                setTimeout(() => { toast.remove(); }, 500);
            }, 3500);
        }
    </script>
</body>
</html>