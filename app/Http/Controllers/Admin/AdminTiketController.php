<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;

class AdminTiketController extends Controller
{
    // Cek apakah user adalah admin
    private function onlyAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Kamu bukan admin!');
        }
    }

    // Halaman dashboard admin
    public function index()
    {
        $this->onlyAdmin();

        $tikets = Tiket::with('event', 'user')->get();
        $events = Event::all();
        $users = User::all();

        // Total tiket yang dibeli (jumlah quantity semua tiket)
        $totalTiket = $tikets->sum('quantity');

        // Tiket yang sudah bayar
        $tiketSudahBayar = Tiket::where('status', 'sudah_dibayar')->count();

        // Tiket yang belum bayar (pending)
        $tiketBelumBayar = Tiket::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'tikets', 'events', 'users',
            'totalTiket', 'tiketSudahBayar', 'tiketBelumBayar'
        ));
    }

    // Menampilkan daftar tiket yang menunggu verifikasi
    public function daftarVerifikasi()
    {
        $this->onlyAdmin();

        $tiket = Tiket::where('status', 'menunggu_verifikasi')->get();
        return view('admin.verifikasi.index', compact('tiket'));
    }

    // Menampilkan detail tiket untuk verifikasi
    public function show($id)
    {
        $this->onlyAdmin();

        $tiket = Tiket::findOrFail($id);
        return view('admin.verifikasi.show', compact('tiket'));
    }

    // Konfirmasi tiket (ubah status menjadi sudah_dibayar)
    public function konfirmasi($id)
    {
        $this->onlyAdmin();

        $tiket = Tiket::findOrFail($id);

        if ($tiket->status !== 'menunggu_verifikasi') {
            return redirect()->route('admin.tiket.verifikasi')
                ->with('error', 'Tiket tidak valid untuk dikonfirmasi.');
        }

        $tiket->status = 'sudah_dibayar';

        // Jika kamu punya kolom confirmed_at, aktifkan baris di bawah
        // $tiket->confirmed_at = now();

        $tiket->save();

        return redirect()->route('admin.tiket.verifikasi')
            ->with('success', 'Tiket berhasil dikonfirmasi!');
    }

    // Tolak tiket (ubah status menjadi ditolak)
    public function tolakVerifikasi($id)
    {
        $this->onlyAdmin();

        $tiket = Tiket::findOrFail($id);

        if ($tiket->status !== 'menunggu_verifikasi') {
            return redirect()->route('admin.tiket.verifikasi')
                ->with('error', 'Tiket tidak valid untuk ditolak.');
        }

        $tiket->status = 'ditolak';
        $tiket->save();

        return redirect()->route('admin.tiket.verifikasi')
            ->with('error', 'Tiket telah ditolak.');
    }
}
