<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tigno | Discover Your Perfect Stay</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #0b0f19;
            color: white;
            overflow-x: hidden;
        }

        /* BACKGROUND BLOBS */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            z-index: -1;
        }

        .blob1 {
            width: 350px;
            height: 350px;
            background: #ff385c;
            top: 10%;
            left: 5%;
        }

        .blob2 {
            width: 400px;
            height: 400px;
            background: #2563eb;
            right: 5%;
            top: 40%;
        }

        .blob3 {
            width: 300px;
            height: 300px;
            background: #10b981;
            bottom: 10%;
            left: 40%;
        }

        /* GLASSMORPHISM */
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 30px;
        }

        /* NAVBAR */
        .navbar-brand {
            font-size: 28px;
        }

        .nav-link {
            color: white !important;
            opacity: 0.8;
            transition: 0.3s;
        }

        .nav-link:hover {
            opacity: 1;
        }

        /* HERO SECTION */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero-box {
            padding: 50px;
        }

        .hero h1 {
            font-size: 65px;
            font-weight: 800;
            line-height: 1.1;
        }

        .hero p {
            font-size: 20px;
            opacity: 0.8;
        }

        .btn-main {
            background: #ff385c;
            border: none;
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 700;
        }

        .btn-main:hover {
            background: #e61e4d;
        }

        /* HOTEL PREVIEW */
        .hotel-preview {
            padding: 20px;
        }

        .hotel-image {
            height: 500px;
            border-radius: 25px;
            overflow: hidden;
        }

        .hotel-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .booking-widget {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            padding: 25px;
        }

        .feature-box {
            display: flex;
            gap: 20px;
        }

        .feature-box i {
            font-size: 30px;
            color: #ff385c;
        }

        /* CARDS HOVER ANIMATIONS */
        .room-card, .event-card {
            transition: 0.4s;
        }

        .room-card:hover, .event-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .room-card img, .event-card img {
            transition: 0.5s;
        }

        .room-card:hover img, .event-card:hover img {
            transform: scale(1.08);
        }

        .choice-card {
            cursor: pointer;
            transition: 0.4s;
        }

        .choice-card:hover {
            transform: translateY(-15px);
            background: rgba(255, 255, 255, 0.15);
        }

        /* FADE-UP ANIMATION */
        .fade-up {
            animation: fade 0.8s ease;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: none;
            }
        }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 42px;
            }
            .hero-box {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <!-- Background Blobs -->
    <div class="blob blob1"></div>
    <div class="blob blob2"></div>
    <div class="blob blob3"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="/">
                <i class="bi bi-building-check text-danger"></i> Tigno 
            </a>

            <button class="navbar-toggler bg-light" data-bs-toggle="collapse" data-bs-target="#menu">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a href="#rooms" class="nav-link">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a href="#events" class="nav-link">Events</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login.user') }}" class="btn btn-outline-light rounded-pill px-4">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill px-4">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="glass hero-box fade-up">
                        <span class="badge bg-danger rounded-pill px-3 py-2 mb-4">Premium Hotel Experience</span>
                        <h1>Discover Your Perfect Stay Before Arrival</h1>
                        <p class="mt-4">
                            Explore luxurious rooms, relaxing accommodations, and unforgettable events through Tigno. Your next experience starts here.
                        </p>

                        <div class="mt-5 d-flex gap-3 flex-wrap">
                            <a href="{{ route('start') }}" class="btn btn-main btn-lg">
                                <i class="bi bi-search"></i> Explore Booking
                            </a>
                            <a href="#rooms" class="btn btn-outline-light btn-lg rounded-pill px-4">View Rooms</a>
                        </div>

                        <div class="row mt-5">
                            <div class="col-4">
                                <h3 class="fw-bold">500+</h3>
                                <p>Guests</p>
                            </div>
                            <div class="col-4">
                                <h3 class="fw-bold">50+</h3>
                                <p>Rooms</p>
                            </div>
                            <div class="col-4">
                                <h3 class="fw-bold">24/7</h3>
                                <p>Support</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="position-relative hotel-preview">
                        <div class="hotel-image">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945" alt="Hotel Preview">
                        </div>

                        <div class="glass booking-widget">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="fw-bold">Luxury Suite</h4>
                                    <p class="mb-0">Available Today</p>
                                </div>
                                <span class="badge bg-success h-25">Available</span>
                            </div>
                            <hr>
                            <div class="feature-box">
                                <div>
                                    <i class="bi bi-house-heart"></i>
                                </div>
                                <div>
                                    <h6>Premium Comfort</h6>
                                    <small>Modern rooms with complete amenities</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ROOMS EXPLORER -->
    <section id="rooms" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary rounded-pill px-3 py-2">Explore Accommodation</span>
                <h2 class="display-4 fw-bold mt-3">Find Your Perfect Room</h2>
                <p class="opacity-75 fs-5">Choose from comfortable rooms designed for relaxation, business trips, and memorable vacations.</p>
            </div>

            <div class="row g-4">
                @forelse($rooms as $room)
                    <div class="col-lg-4 col-md-6">
                        <div class="glass h-100 overflow-hidden room-card">
                            <div style="height:280px; overflow:hidden;">
                                @if($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $room->name }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a" class="w-100 h-100" style="object-fit:cover;" alt="Default Room Image">
                                @endif
                            </div>

                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="fw-bold">{{ $room->name }}</h3>
                                    <span class="badge bg-danger">₱{{ number_format($room->price) }}</span>
                                </div>

                                <p class="opacity-75 mt-3">{{ $room->description }}</p>

                                <div class="row mt-4">
                                    <div class="col-6">
                                        <i class="bi bi-people-fill text-danger"></i> {{ $room->capacity }} Guests
                                    </div>
                                    <div class="col-6">
                                        <i class="bi bi-check-circle-fill text-success"></i> Available
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill px-4">Reserve</a>
                                    <a href="#" class="btn btn-outline-light rounded-pill">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- DEFAULT DISPLAY IF NO DATABASE DATA -->
                    <div class="col-lg-4 col-md-6">
                        <div class="glass p-4 h-100">
                            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427" class="w-100 rounded-4" height="250" style="object-fit:cover;" alt="Deluxe Room">
                            <h3 class="mt-4 fw-bold">Deluxe Room</h3>
                            <p class="opacity-75">Perfect room for couples and travelers.</p>
                            <h5>₱2,500 / Night</h5>
                            <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill mt-3">Book Now</a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="glass p-4 h-100">
                            <img src="https://images.unsplash.com/photo-1591088398332-8a7791972843" class="w-100 rounded-4" height="250" style="object-fit:cover;" alt="Executive Suite">
                            <h3 class="mt-4 fw-bold">Executive Suite</h3>
                            <p class="opacity-75">Spacious accommodation for families.</p>
                            <h5>₱4,000 / Night</h5>
                            <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill mt-3">Book Now</a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="glass p-4 h-100">
                            <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7" class="w-100 rounded-4" height="250" style="object-fit:cover;" alt="Luxury Villa">
                            <h3 class="mt-4 fw-bold">Luxury Villa</h3>
                            <p class="opacity-75">Premium private accommodation.</p>
                            <h5>₱8,500 / Night</h5>
                            <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill mt-3">Book Now</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- EVENTS SECTION -->
    <section id="events" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Premium Events</span>
                <h2 class="display-4 fw-bold mt-3">Create Unforgettable Moments</h2>
                <p class="opacity-75 fs-5">From weddings to corporate gatherings, discover venues designed for every occasion.</p>
            </div>

            <div class="row g-4">
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="glass overflow-hidden h-100 event-card">
                            <div style="height:260px; overflow:hidden;">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $event->name }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3" class="w-100 h-100" style="object-fit:cover;" alt="Default Event Image">
                                @endif
                            </div>

                            <div class="p-4">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary">{{ $event->category }}</span>
                                    <span><i class="bi bi-people-fill text-danger"></i> {{ $event->capacity }}</span>
                                </div>

                                <h3 class="fw-bold mt-4">{{ $event->name }}</h3>
                                <p class="opacity-75">{{ $event->description }}</p>

                                <div class="mt-3">
                                    <p class="mb-2"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $event->location }}</p>
                                    <p><i class="bi bi-calendar-event text-danger"></i> {{ date('M d, Y', strtotime($event->start_date)) }}</p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <h5 class="fw-bold mb-0">₱{{ number_format($event->price) }}</h5>
                                    <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill">Reserve Venue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- DEFAULT EVENT DISPLAY -->
                    <div class="col-lg-4 col-md-6">
                        <div class="glass p-4 h-100">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3" class="rounded-4 w-100" height="240" style="object-fit:cover;" alt="Grand Wedding Reception">
                            <h3 class="fw-bold mt-4">Grand Wedding Reception</h3>
                            <p class="opacity-75">Elegant ballroom perfect for weddings.</p>
                            <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill mt-3">Book Venue</a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="glass p-4 h-100">
                            <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678" class="rounded-4 w-100" height="240" style="object-fit:cover;" alt="Corporate Conference">
                            <h3 class="fw-bold mt-4">Corporate Conference</h3>
                            <p class="opacity-75">Professional venue for business meetings.</p>
                            <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill mt-3">Book Venue</a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="glass p-4 h-100">
                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30" class="rounded-4 w-100" height="240" style="object-fit:cover;" alt="Celebration Party">
                            <h3 class="fw-bold mt-4">Celebration Party</h3>
                            <p class="opacity-75">Celebrate special moments with your loved ones.</p>
                            <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill mt-3">Book Venue</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- IMMERSIVE EXPERIENCE -->
    <section class="py-5">
        <div class="container">
            <div class="glass p-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="badge bg-success rounded-pill px-3 py-2">Virtual Experience</span>
                        <h2 class="display-5 fw-bold mt-3">Experience Tigno Before Your Arrival</h2>
                        <p class="opacity-75 fs-5">Explore our accommodations, facilities, and event spaces before making your reservation.</p>

                        <div class="row mt-4 g-3">
                            <div class="col-6">
                                <div class="glass p-3 text-center">
                                    <i class="bi bi-house-heart-fill fs-1 text-danger"></i>
                                    <h6 class="mt-3">Luxury Rooms</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass p-3 text-center">
                                    <i class="bi bi-water fs-1 text-primary"></i>
                                    <h6 class="mt-3">Relaxation Area</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass p-3 text-center">
                                    <i class="bi bi-cup-hot-fill fs-1 text-warning"></i>
                                    <h6 class="mt-3">Dining Experience</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass p-3 text-center">
                                    <i class="bi bi-calendar-event-fill fs-1 text-success"></i>
                                    <h6 class="mt-3">Event Venue</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c" class="rounded-5 w-100" style="height:500px; object-fit:cover;" alt="Property Tour Preview">
                            <div class="glass position-absolute bottom-0 start-0 end-0 m-4 p-4">
                                <h4 class="fw-bold">360° Property Preview</h4>
                                <p class="mb-3 opacity-75">Walk through our premium spaces and discover your ideal experience.</p>
                                <button class="btn btn-danger rounded-pill px-4">
                                    <i class="bi bi-play-circle"></i> Start Tour
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SMART BOOKING ASSISTANT -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary rounded-pill px-3 py-2">Smart Recommendation</span>
                <h2 class="display-5 fw-bold mt-3">Not Sure What To Choose?</h2>
                <p class="opacity-75">Tell us your purpose and we will suggest the best option.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="glass p-4 text-center choice-card" onclick="recommend('couple')">
                        <i class="bi bi-heart-fill fs-1 text-danger"></i>
                        <h4 class="mt-3">Couple Trip</h4>
                        <p class="opacity-75">Romantic and comfortable rooms.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="glass p-4 text-center choice-card" onclick="recommend('family')">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                        <h4 class="mt-3">Family Vacation</h4>
                        <p class="opacity-75">Spacious rooms for everyone.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="glass p-4 text-center choice-card" onclick="recommend('business')">
                        <i class="bi bi-briefcase-fill fs-1 text-success"></i>
                        <h4 class="mt-3">Business Trip</h4>
                        <p class="opacity-75">Professional accommodation.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="glass p-4 text-center choice-card" onclick="recommend('event')">
                        <i class="bi bi-stars fs-1 text-warning"></i>
                        <h4 class="mt-3">Special Event</h4>
                        <p class="opacity-75">Celebrate unforgettable moments.</p>
                    </div>
                </div>
            </div>

            <div id="recommendation" class="glass p-4 mt-5 text-center" style="display:none;">
                <h3 class="fw-bold">Recommended For You</h3>
                <p id="recommendText" class="fs-5 opacity-75"></p>
                <a href="{{ route('customer.register') }}" class="btn btn-danger rounded-pill px-5">Continue Booking</a>
            </div>
        </div>
    </section>

    <!-- TRUST SECTION -->
    <section class="py-5">
        <div class="container">
            <div class="glass p-5">
                <div class="text-center mb-5">
                    <span class="badge bg-danger rounded-pill px-3 py-2">Why Choose Tigno</span>
                    <h2 class="display-5 fw-bold mt-3">A Better Way To Book Your Stay</h2>
                    <p class="opacity-75">Designed for comfort, security, and a seamless reservation experience.</p>
                </div>

                <div class="row g-4 text-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4">
                            <i class="bi bi-shield-check fs-1 text-success"></i>
                            <h4 class="fw-bold mt-3">Secure Booking</h4>
                            <p class="opacity-75">Your reservation details are protected.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4">
                            <i class="bi bi-house-check-fill fs-1 text-danger"></i>
                            <h4 class="fw-bold mt-3">Quality Rooms</h4>
                            <p class="opacity-75">Comfortable accommodations for every guest.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4">
                            <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
                            <h4 class="fw-bold mt-3">Fast Reservation</h4>
                            <p class="opacity-75">Simple booking process with quick confirmation.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4">
                            <i class="bi bi-headset fs-1 text-primary"></i>
                            <h4 class="fw-bold mt-3">24/7 Support</h4>
                            <p class="opacity-75">Assistance whenever you need help.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GUEST REVIEWS -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Guest Experiences</span>
                <h2 class="display-5 fw-bold mt-3">What Our Guests Say</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="glass p-4 h-100">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-danger p-3">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold mb-0">Maria Santos</h5>
                                <small class="opacity-75">Dagupan City</small>
                            </div>
                        </div>
                        <div class="mt-4 text-warning fs-4">★★★★★</div>
                        <p class="mt-3 opacity-75">"The booking process was easy and the room experience was excellent."</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="glass p-4 h-100">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary p-3">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold mb-0">John Cruz</h5>
                                <small class="opacity-75">Lingayen</small>
                            </div>
                        </div>
                        <div class="mt-4 text-warning fs-4">★★★★★</div>
                        <p class="mt-3 opacity-75">"Modern system, fast reservation, and very convenient."</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="glass p-4 h-100">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success p-3">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold mb-0">Angela Reyes</h5>
                                <small class="opacity-75">Pangasinan</small>
                            </div>
                        </div>
                        <div class="mt-4 text-warning fs-4">★★★★★</div>
                        <p class="mt-3 opacity-75">"The room selection feature helped me find the perfect place."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="py-5">
        <div class="container">
            <div class="glass p-5 text-center">
                <h2 class="display-4 fw-bold">Ready For Your Next Experience?</h2>
                <p class="fs-5 opacity-75">Create an account and start exploring rooms and venues today.</p>

                <div class="mt-4">
                    <a href="{{ route('customer.register') }}" class="btn btn-danger btn-lg rounded-pill px-5">Create Account</a>
                    <a href="{{ route('login.user') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 ms-2">Login</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-5">
        <div class="container">
            <div class="glass p-5">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h3 class="fw-bold">
                            <i class="bi bi-building-check text-danger"></i> Tigno 
                        </h3>
                        <p class="opacity-75">A modern reservation platform for rooms, events, and memorable experiences.</p>
                    </div>

                    <div class="col-lg-4">
                        <h5 class="fw-bold">Contact</h5>
                        <p class="mb-2"><i class="bi bi-geo-alt-fill text-danger"></i> Lingayen, Pangasinan</p>
                        <p><i class="bi bi-envelope-fill text-danger"></i> support@tignobooking.com</p>
                    </div>

                    <div class="col-lg-4">
                        <h5 class="fw-bold">Follow Us</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="btn btn-outline-light rounded-circle"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="text-center opacity-75">
                    © {{ date('Y') }} Tigno. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function recommend(type) {
            let text = "";

            if (type === "couple") {
                text = "Recommended: Deluxe Room - Romantic comfort with premium amenities.";
            } else if (type === "family") {
                text = "Recommended: Executive Suite - Spacious accommodation for families.";
            } else if (type === "business") {
                text = "Recommended: Executive Room - Perfect for meetings and work trips.";
            } else if (type === "event") {
                text = "Recommended: Grand Event Venue - Create unforgettable celebrations.";
            }

            document.getElementById("recommendText").innerText = text;
            document.getElementById("recommendation").style.display = "block";
        }

        // Simple reveal animation
        const elements = document.querySelectorAll(".glass");
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("fade-up");
                }
            });
        });

        elements.forEach((el) => observer.observe(el));
    </script>
</body>
</html>