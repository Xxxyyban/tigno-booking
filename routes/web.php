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
            'role' => 'admin'
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Admin user is ready!',
        'user' => $user
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

    return view('welcome', compact(
        'rooms',
        'events'
    ));

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

require __DIR__ . '/auth.php';



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


    if(auth()->user()->isAdmin()) {

        return redirect()
            ->route('admin.dashboard');

    }


    return redirect()
        ->route('customer.dashboard');


})->name('dashboard');





/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {



    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', function () {


        abort_unless(
            auth()->user()->isAdmin(),
            403
        );


        return view('admin.admin-home');


    })->name('admin.dashboard');






    /*
    |--------------------------------------------------------------------------
    | ADMIN CALENDAR
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/calendar', function () {


        abort_unless(
            auth()->user()->isAdmin(),
            403
        );


        return view('admin.calendar');


    })->name('admin.calendar');







    /*
    |--------------------------------------------------------------------------
    | CALENDAR EVENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/bookings/events', function () {


        abort_unless(
            auth()->user()->isAdmin(),
            403
        );



        return \App\Models\Booking::all()
            ->map(function ($booking) {


                return [

                    'title' =>
                        $booking->room_type .
                        ' | ' .
                        ($booking->place ?? 'N/A'),


                    'start' =>
                        $booking->booking_datetime,


                    'end' =>
                        $booking->end_datetime,


                    'color' =>
                        '#ff385c',

                ];


            });


    })->name('admin.events');







    /*
    |--------------------------------------------------------------------------
    | BOOKING CRUD
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('bookings', BookingController::class);
    });


});







/*
|--------------------------------------------------------------------------
| CUSTOMER SYSTEM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {




    /*
    |--------------------------------------------------------------------------
    | CUSTOMER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/customer/dashboard', function () {


        abort_unless(
            auth()->user()->isCustomer(),
            403
        );


        return view('dashboard');


    })->name('customer.dashboard');








    /*
    |--------------------------------------------------------------------------
    | BOOKING PROCESS
    |--------------------------------------------------------------------------
    */

    Route::prefix('booking')->group(function () {




        /*
        |--------------------------------------------------------------------------
        | START BOOKING
        |--------------------------------------------------------------------------
        */

        Route::get('/start', [

            TignoBookingController::class,
            'start'

        ])->name('booking.start');








        /*
        |--------------------------------------------------------------------------
        | DETAILS
        |--------------------------------------------------------------------------
        */

        Route::get('/details', function () {


            abort_unless(
                auth()->user()->isCustomer(),
                403
            );


            return app(
                TignoBookingController::class
            )->showDetails();



        })->name('booking.details');




        Route::post('/details', [

            TignoBookingController::class,
            'storeDetails'

        ])->name('booking.details.store');








        /*
        |--------------------------------------------------------------------------
        | CONFIRMATION
        |--------------------------------------------------------------------------
        */

        Route::get('/confirmation', [

            TignoBookingController::class,
            'showConfirmation'

        ])->name('booking.confirmation');





        Route::post('/confirmation', [

            TignoBookingController::class,
            'uploadConfirmation'

        ])->name('booking.confirmation.store');








        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        Route::get('/summary', [

            TignoBookingController::class,
            'summary'

        ])->name('booking.summary');




    });



});