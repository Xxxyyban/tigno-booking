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
        return view('admin.bookings.create', compact('events'));
    }

    /**
     * STORE BOOKING
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'booking_id' => 'required|unique:bookings,booking_id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'booking_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:booking_datetime',
            'guests' => 'required|integer|min:1',
            'room_type' => 'required|string', // 🔥 FIX ADDED
            'notes' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

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
        return view('admin.bookings.edit', compact('booking', 'events'));
    }

    /**
     * UPDATE BOOKING
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'booking_id' => 'required|unique:bookings,booking_id,' . $booking->id,
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'booking_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:booking_datetime',
            'guests' => 'required|integer|min:1',
            'room_type' => 'required|string', // 🔥 FIX ADDED
            'notes' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('receipt')) {

            if ($booking->receipt && Storage::disk('public')->exists($booking->receipt)) {
                Storage::disk('public')->delete($booking->receipt);
            }

            $validated['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        $booking->update($validated); // ✅ THIS MAKES UPDATE WORK

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