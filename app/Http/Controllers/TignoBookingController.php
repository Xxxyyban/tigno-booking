<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TignoBookingController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | START BOOKING
    |--------------------------------------------------------------------------
    */
    public function start()
    {
        $customerName = Auth::user()->name;

        session([
            'customer_name' => $customerName
        ]);

        return view('start', compact('customerName'));
    }



    /*
    |--------------------------------------------------------------------------
    | SHOW BOOKING DETAILS
    |--------------------------------------------------------------------------
    */
    public function showDetails()
    {
        $events = Event::whereIn('status', ['active', 'upcoming'])
            ->orderBy('start_date', 'asc')
            ->get();

        return view('details', [
            'events' => $events,
            'user' => Auth::user()
        ]);
    }



    /*
    |--------------------------------------------------------------------------
    | CHECK EVENT AVAILABILITY
    |--------------------------------------------------------------------------
    */
    private function isAvailable($eventId, $start, $end)
    {
        return !Booking::where('event_id', $eventId)
            ->where(function($query) use ($start, $end) {

                $query->whereBetween('booking_datetime', [$start, $end])

                ->orWhereBetween('end_datetime', [$start, $end])

                ->orWhere(function($q) use ($start, $end) {

                    $q->where('booking_datetime', '<=', $start)
                      ->where('end_datetime', '>=', $end);

                });

            })
            ->exists();
    }



    /*
    |--------------------------------------------------------------------------
    | STORE BOOKING DETAILS
    |--------------------------------------------------------------------------
    */
    public function storeDetails(Request $request)
    {

        if ($request->filled('booking_datetime') &&
            $request->filled('end_datetime')) {

            try {

                $request->merge([

                    'booking_datetime' =>
                    Carbon::parse($request->booking_datetime)
                    ->toDateTimeString(),

                    'end_datetime' =>
                    Carbon::parse($request->end_datetime)
                    ->toDateTimeString(),

                ]);

            } catch (\Exception $e) {

            }
        }



        $validated = $request->validate([

            'booking_id'       => 'required|string|max:20',

            'contact'          => 'required|string|max:20',

            'booking_datetime' => 'required|date|after:now',

            'end_datetime'     => 'required|date|after:booking_datetime',

            'guests'           => 'required|integer|min:1',

            'event_id'         => 'required|exists:events,id',

            'room_type'        => 'required|string',

            'notes'            => 'nullable|string',

        ]);



        $event = Event::findOrFail($validated['event_id']);



        if (!$this->isAvailable(

            $validated['event_id'],

            $validated['booking_datetime'],

            $validated['end_datetime']

        )) {


            return back()

                ->withErrors([

                    'booking_datetime' =>
                    'This exact timeframe has already been reserved.'

                ])

                ->withInput();

        }



        $user = Auth::user();



        session([

            'user_id'          => $user->id,

            'booking_id'       => $validated['booking_id'],

            'first_name'       => explode(' ', $user->name)[0],

            'last_name'        => explode(' ', $user->name)[1] ?? '',

            'full_name'        => $user->name,

            'email'            => $user->email,

            'contact'          => $validated['contact'],

            'booking_datetime' => $validated['booking_datetime'],

            'end_datetime'     => $validated['end_datetime'],

            'guests'           => $validated['guests'],

            'event_id'         => $event->id,

            'event_name'       => $event->name,

            'room_type'        => $validated['room_type'],

            'notes'            => $validated['notes'],

        ]);



        return redirect()
            ->route('booking.confirmation');

    }



    /*
    |--------------------------------------------------------------------------
    | CONFIRMATION PAGE
    |--------------------------------------------------------------------------
    */
    public function showConfirmation()
    {

        if (!session()->has('booking_id')) {

            return redirect()
                ->route('booking.details');

        }


        return view('confirmation');

    }



    /*
    |--------------------------------------------------------------------------
    | UPLOAD RECEIPT AND SAVE BOOKING
    |--------------------------------------------------------------------------
    */
    public function uploadConfirmation(Request $request)
    {

        $request->validate([

            'receipt' =>
            'required|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);



        $path = $request
            ->file('receipt')
            ->store('receipts','public');



        Booking::create([

            'user_id'          => session('user_id'),

            'event_id'         => session('event_id'),

            'booking_id'       => session('booking_id'),

            'first_name'       => session('first_name'),

            'last_name'        => session('last_name'),

            'full_name'        => session('full_name'),

            'email'            => session('email'),

            'contact'          => session('contact'),

            'booking_datetime' => session('booking_datetime'),

            'end_datetime'     => session('end_datetime'),

            'guests'           => session('guests'),

            'room_type'        => session('room_type'),

            'notes'            => session('notes'),

            'receipt'          => $path,

        ]);



        session([
            'receipt' => $path
        ]);



        return redirect()
            ->route('booking.summary');

    }



    /*
    |--------------------------------------------------------------------------
    | SUMMARY PAGE
    |--------------------------------------------------------------------------
    */
    public function summary()
    {

        if (!session()->has('booking_id')) {

            return redirect()
                ->route('booking.details');

        }


        return view('summary');

    }

}