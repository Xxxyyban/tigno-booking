<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TignoBookingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Room;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| TEMPORARY ADMIN CREATION (RUN ONCE THEN DELETE)
|--------------------------------------------------------------------------
*/
Route::get('/setup-admin-now', function () {
    $user = User::firstOrCreate(
        ['email' => 'admin@tigno.com'],
        [
            'name' => 'Admin User',
            'password' => Hash::make('angelo123'),
            'role' => 'admin',
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Admin user is ready!',
        'user' => $user,
    ]);
});

/*
|--------------------------------------------------------------------------
| WELCOME PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $rooms = Room::all();
    $events = Event::all();

    return view('welcome', compact('rooms', 'events'));
})->name('welcome');

/*
|--------------------------------------------------------------------------
| START PAGE
|--------------------------------------------------------------------------
*/
Route::get('/start', function () {
    return view('start');
})->name('start');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| CUSTOM LOGIN PAGE
|--------------------------------------------------------------------------
*/
Route::get('/login-user', function () {
    return view('auth.login-user');
})->name('login.user');

/*
|--------------------------------------------------------------------------
| CUSTOMER REGISTER
|--------------------------------------------------------------------------
*/
Route::get('/customer/register', [
    RegisteredUserController::class,
    'create'
])->name('customer.register');

Route::post('/customer/register', [
    RegisteredUserController::class,
    'store'
])->name('customer.register.store');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {

    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('customer.dashboard');

})->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            abort_unless(auth()->user()->isAdmin(), 403);

            return view('admin.admin-home');
        })->name('dashboard');

        Route::get('/calendar', function () {
            abort_unless(auth()->user()->isAdmin(), 403);

            return view('admin.calendar');
        })->name('calendar');

        Route::get('/admin/users', function () {
            return view('admin.bookings.users');
        })->name('admin.users');

        Route::get('/bookings/events', function () {
            abort_unless(auth()->user()->isAdmin(), 403);

            return \App\Models\Booking::all()->map(function ($booking) {

                return [
                    'title' => $booking->room_type.' | '.($booking->place ?? 'N/A'),
                    'start' => $booking->booking_datetime,
                    'end' => $booking->end_datetime,
                    'color' => '#ff385c',
                ];
            });

        })->name('events');

        Route::get('/bookings/{booking}/receipt', [BookingController::class, 'downloadReceipt'])->name('bookings.receipt');

        Route::resource('bookings', BookingController::class);
    });

/*
|--------------------------------------------------------------------------
| CUSTOMER SYSTEM
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/customer/dashboard', function () {

        abort_unless(auth()->user()->isCustomer(), 403);

        return view('dashboard');

    })->name('customer.dashboard');

    Route::prefix('booking')->group(function () {

        Route::get('/start', [
            TignoBookingController::class,
            'start'
        ])->name('booking.start');

        Route::get('/details', function () {

            abort_unless(auth()->user()->isCustomer(), 403);

            return app(
                TignoBookingController::class
            )->showDetails();

        })->name('booking.details');

        Route::post('/details', [
            TignoBookingController::class,
            'storeDetails'
        ])->name('booking.details.store');

        Route::get('/confirmation', [
            TignoBookingController::class,
            'showConfirmation'
        ])->name('booking.confirmation');

        Route::post('/confirmation', [
            TignoBookingController::class,
            'uploadConfirmation'
        ])->name('booking.confirmation.store');

        Route::get('/summary', [
            TignoBookingController::class,
            'summary'
        ])->name('booking.summary');

    });

});