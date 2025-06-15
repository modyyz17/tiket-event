<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show($id)
{
    $event = Event::findOrFail($id); // Ambil data event
    return view('events.show', compact('event')); // Tampilkan ke view
}


    public function dashboard()
    {
        $events = Event::latest()->get(); // ambil semua event
        return view('dashboard', compact('events'));
    }


    public function konser(Request $request)
{
    $query = Event::where('category', 'konser');

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $events = $query->get();

    return view('events.konser', compact('events'));
}

 public function seminar(Request $request)
{
    $query = Event::where('category', 'seminar');

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $events = $query->get();

    return view('events.seminar', compact('events'));
}

 public function pameran(Request $request)
{
    $query = Event::where('category', 'pameran');

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $events = $query->get();

    return view('events.pameran', compact('events'));
}

 public function gameshow(Request $request)
{
    $query = Event::where('category', 'gameshow');

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $events = $query->get();

    return view('events.gameshow', compact('events'));
}



    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'image' => 'nullable|image',
            'category' => 'required|in:seminar,konser,gameshow,pameran',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);
        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan');
    }
}
