<?php

// TiketController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;

class TiketController extends Controller
{
    public function create($event)
    {
        return view('tiket.beli', ['event' => $event]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'event' => 'required|string',
        ]);

        Tiket::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'event' => $request->event,
        ]);

        return redirect('/dashboard')->with('success', 'Tiket berhasil dibeli!');
    }
}
