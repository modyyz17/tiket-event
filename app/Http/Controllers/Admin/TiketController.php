<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Event;
use App\Models\User;

class AdminTiketController extends Controller
{
    public function index()
    {
        $tikets = Tiket::with(['user', 'event'])->get();
        return view('admin.tiket.index', compact('tikets'));
    }

    public function edit($id)
    {
        $tiket = Tiket::with('event', 'user')->findOrFail($id);
        return view('admin.tiket.edit', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update($request->only('status'));
        return redirect()->route('admin.tiket')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function show($id)
    {
        $tiket = Tiket::with('event', 'user')->findOrFail($id);
        return view('admin.tiket.show', compact('tiket'));
    }

    public function konfirmasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->status = 'confirmed';
        $tiket->save();

        return redirect()->back()->with('success', 'Pembayaran telah dikonfirmasi.');
    }

    public function daftarVerifikasi()
    {
        $tikets = Tiket::where('status', 'waiting')->with('user', 'event')->get();
        return view('admin.tiket.verifikasi', compact('tikets'));
    }

    public function tolakVerifikasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->status = 'rejected';
        $tiket->save();

        return redirect()->back()->with('success', 'Pembayaran ditolak.');
    }
}