<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;

class AdminController extends Controller
{
    public function tiket()
    {
        $tikets = Tiket::with('user', 'event')->orderByDesc('created_at')->get();
        return view('admin.tiket', compact('tikets'));
    }

    public function konfirmasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->status = 'confirmed';
        $tiket->save();

        return redirect()->route('admin.tiket')->with('success', 'Tiket telah dikonfirmasi.');
    }
}
