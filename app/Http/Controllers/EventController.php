<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        Event::create($request->all());

        return redirect('/events')->with('success', 'Event created');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $event->update($request->all());

        return redirect('/events')->with('success', 'Updated');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect('/events')->with('success', 'Deleted');
    }
}
