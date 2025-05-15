<?php

namespace App\Http\Controllers;

use App\Models\Event; // Pastikan sudah ada model Event
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan daftar semua event
    public function index()
    {
        $events = Event::all(); // Ambil semua data event dari database
        return view('events.index', compact('events')); // Pastikan view ini ada di resources/views/events/index.blade.php
    }

    // Menampilkan detail event berdasarkan ID
    public function show($id)
    {
        $event = Event::findOrFail($id); // Ambil event berdasarkan ID
        return view('events.show', compact('event')); // Pastikan view ini ada di resources/views/events/show.blade.php
    }
}
