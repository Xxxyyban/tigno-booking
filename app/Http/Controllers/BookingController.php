<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * ADMIN LIST
     */
    public function index()
    {
        $bookings = Booking::with('event')->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        $events = Event::all();
        $user = auth()->user(); // Passed to ensure the view gets the logged-in user details

        // Change this view path if your frontend view is located elsewhere (e.g., 'booking.create')
        return view('admin.bookings.create', compact('events', 'user'));
    }

    /**
     * STORE BOOKING
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'booking_id' => 'required|unique:bookings,booking_id',
            'contact' => 'required|string|max:20',
            'booking_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:booking_datetime',
            'guests' => 'required|integer|min:1',
            'room_type' => 'required|string',
            'notes' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Automatically assign the logged-in user ID
        $validated['user_id'] = auth()->id();

        // Automatically use the logged-in user's name and email if not provided in request
        $currentUser = auth()->user();
        $fullName = $currentUser->name ?? 'Guest User';
        $validated['email'] = $currentUser->email ?? 'guest@example.com';
        $validated['first_name'] = $currentUser->first_name ?? explode(' ', trim($fullName), 2)[0];
        $validated['last_name'] = $currentUser->last_name ?? (isset(explode(' ', trim($fullName), 2)[1]) ? explode(' ', trim($fullName), 2)[1] : '');

        if ($request->hasFile('receipt')) {
            $validated['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        Booking::create($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * SHOW SINGLE BOOKING
     */
    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * EDIT FORM
     */
    public function edit(Booking $booking)
    {
        $events = Event::all();
        $user = auth()->user();
        
        return view('admin.bookings.edit', compact('booking', 'events', 'user'));
    }

    /**
     * UPDATE BOOKING
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'booking_id' => 'required|unique:bookings,booking_id,' . $booking->id,
            'contact' => 'required|string|max:20',
            'booking_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:booking_datetime',
            'guests' => 'required|integer|min:1',
            'room_type' => 'required|string',
            'notes' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Retain user data association
        $currentUser = auth()->user();
        $fullName = $currentUser->name ?? 'Guest User';
        $validated['email'] = $currentUser->email ?? $booking->email;
        $validated['first_name'] = explode(' ', trim($fullName), 2)[0];
        $validated['last_name'] = isset(explode(' ', trim($fullName), 2)[1]) ? explode(' ', trim($fullName), 2)[1] : '';

        if ($request->hasFile('receipt')) {
            if ($booking->receipt && Storage::disk('public')->exists($booking->receipt)) {
                Storage::disk('public')->delete($booking->receipt);
            }

            $validated['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        $booking->update($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * DELETE BOOKING
     */
    public function destroy(Booking $booking)
    {
        if ($booking->receipt && Storage::disk('public')->exists($booking->receipt)) {
            Storage::disk('public')->delete($booking->receipt);
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}