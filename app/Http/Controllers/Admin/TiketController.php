<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\KategoriTiket;

class TiketController extends Controller
{
    public function index()
    {
        $tiket = Tiket::with('kategori')->get();
        return view('admin.tiket.index', compact('tiket'));
    }

    public function create()
    {
        $kategori = KategoriTiket::all();
        return view('admin.tiket.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }
        Tiket::create($data);
        return redirect()->route('tiket.index');
    }
}
