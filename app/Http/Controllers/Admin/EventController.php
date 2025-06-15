<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

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
        'title' => 'required',
        'description' => 'nullable',
        'category' => 'required',
        'date' => 'required',
        'location' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('events', 'public');
    }

    Event::create([
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'date' => $request->date,
        'location' => $request->location,
        'price' => $request->price, // <-- ini WAJIB ADA!
        'image' => $imagePath,
    ]);

    return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
}

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'category' => 'required',
            'date' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'category', 'date', 'location', 'price']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function konser()
{
    $events = Event::where('category', 'konser')->get();
    return view('events.konser', compact('events'));
}
public function seminar()
{
    $events = Event::where('category', 'seminar')->get();
    return view('events.seminar', compact('events'));
}

public function gameshow()
{
    $events = Event::where('category', 'gameshow')->get();
    return view('events.gameshow', compact('events'));
}

public function pameran()
{
    $events = Event::where('category', 'pameran')->get();
    return view('events.pameran', compact('events'));
}


}
