<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Halaman daftar Konser
    public function konser()
{
    $konser = Event::where('kategori', 'konser')->get();
    return view('events.konser', compact('konser'));
}

    // Halaman daftar Seminar
    public function seminar()
    {
        $seminar = Event::where('kategori', 'seminar')->get();
        return view('events.seminar', compact('seminar'));
    }

    // Halaman daftar Pameran
    public function pameran()
    {
        $pameran = Event::where('kategori', 'pameran')->get();
        return view('events.pameran', compact('pameran'));
    }

    // Halaman daftar Gameshow
    public function gameshow()
    {
        $gameshow = Event::where('kategori', 'gameshow')->get();
        return view('events.gameshow', compact('gameshow'));
    }
}
