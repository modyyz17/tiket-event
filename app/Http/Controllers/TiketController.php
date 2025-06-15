<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TiketController extends Controller
{
    // ✅ Tampilkan form beli tiket
    public function create($id)
    {
        $event = Event::findOrFail($id);
        return view('tiket.create', compact('event'));
    }

    // ✅ Simpan pembelian tiket
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id'          => 'required|exists:events,id',
            'name'              => 'required|string|max:100',
            'email'             => 'required|email',
            'phone'             => 'nullable|string|max:20',
            'jumlah'            => 'required|integer|min:1|max:10',
            'metode_pembayaran' => 'required|in:bank_transfer,qris,ewallet',
        ]);

        $event = Event::findOrFail($data['event_id']);

        $tiket = Tiket::create([
            'event_id'       => $event->id,
            'name'           => $data['name'],
            'email'          => $data['email'],
            'phone_number'   => $data['phone'] ?? null,
            'quantity'       => $data['jumlah'],
            'total_price'    => $event->price * $data['jumlah'],
            'payment_method' => $data['metode_pembayaran'],
            'status'         => 'pending',
            'ticket_code'    => strtoupper(uniqid('TKT')),
        ]);

        return redirect()->route('tiket.success', $tiket->id)
                         ->with('success', '✅ Tiket berhasil dipesan! Silakan lanjutkan pembayaran.');
    }

    // ✅ Halaman sukses setelah pesan tiket
    public function success($id)
    {
        $tiket = Tiket::with('event')->findOrFail($id);
        return view('tiket.success', compact('tiket'));
    }

    // ✅ Konfirmasi manual oleh user (dummy)
    public function konfirmasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update(['status' => 'paid']);

        return redirect()->route('tiket.final', $id)->with('success', '✅ Pembayaran berhasil dikonfirmasi!');
    }

    // ✅ Halaman final tiket
    public function final($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('tiket.final', compact('tiket'));
    }

    // ✅ Tiket milik user login
    public function myTickets()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $tikets = Tiket::where('email', $user->email)->latest()->get();
        return view('tiket.my', compact('tikets'));
    }

    // ✅ Admin: daftar semua tiket
    public function listAll()
    {
        $tikets = Tiket::with('event')->latest()->get();
        return view('admin.tiket.index', compact('tikets'));
    }

    // ✅ Admin: konfirmasi tiket secara manual
    public function adminKonfirmasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update(['status' => 'paid']);

        return back()->with('success', '✅ Tiket berhasil dikonfirmasi oleh admin!');
    }

    // ✅ Dummy pembayaran (simulasi)
    public function dummyBayar($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update(['status' => 'paid']);

        return redirect()->back()->with('success', '✅ Tiket berhasil dibayar (dummy).');
    }

    // ✅ Tampilkan form upload bukti
    public function formUploadBukti($id)
    {
        $tiket = Tiket::findOrFail($id);

        if ($tiket->status !== 'pending') {
            return redirect()->back()->with('error', '❌ Bukti hanya bisa diunggah untuk tiket yang belum dibayar.');
        }

        return view('tiket.upload', compact('tiket'));
    }

    // ✅ Tampilkan halaman konfirmasi bukti (GET)
    public function showConfirmPage($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('tiket.confirm', compact('tiket'));
    }

    // ✅ Simpan bukti pembayaran (POST)
    public function confirmPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $tiket = Tiket::where('id', $id)
                      ->where('email', auth()->user()->email)
                      ->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/bukti_pembayaran', $filename);

            $tiket->update([
                'payment_proof_path' => $path,
                'status' => 'pending_verification',
            ]);
        }

        return redirect()->route('tiket.my')->with('success', '✅ Bukti pembayaran berhasil dikirim. Menunggu konfirmasi admin.');
    }

    // ✅ Admin: daftar tiket menunggu verifikasi
    public function daftarVerifikasi()
    {
        $tikets = Tiket::with('event')
            ->where('status', 'pending_verification')
            ->latest()
            ->get();

        return view('admin.tiket.verifikasi', compact('tikets'));
    }

    // ✅ Admin: tolak bukti pembayaran
    public function tolakVerifikasi($id)
    {
        $tiket = Tiket::findOrFail($id);

        if ($tiket->status !== 'pending_verification') {
            return back()->with('error', '❌ Tiket tidak dalam status verifikasi.');
        }

        // Hapus file bukti jika ada
        if ($tiket->payment_proof_path && Storage::exists($tiket->payment_proof_path)) {
            Storage::delete($tiket->payment_proof_path);
        }

        $tiket->update([
            'status' => 'pending',
            'payment_proof_path' => null,
        ]);

        if (auth()->check() && auth()->user()->email === $tiket->email) {
            return redirect()->route('tiket.my')->with('error', '❌ Bukti pembayaran kamu ditolak. Silakan upload ulang yang valid.');
        }

        return back()->with('success', '⚠️ Bukti pembayaran ditolak dan status dikembalikan ke pending.');
    }
}
