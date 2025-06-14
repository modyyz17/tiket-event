<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriTiket;

class KategoriTiketController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategori = KategoriTiket::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    // Tampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Simpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriTiket::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kategori = KategoriTiket::findOrFail($id);
        return view
