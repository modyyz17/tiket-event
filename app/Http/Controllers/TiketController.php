<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TiketController extends Controller
{
   public function user() {
    return $this->belongsTo(User::class, 'email', 'email');
}

    public function confirmPayment(Request $request, $id)
    {
         $request->validate([
        'payment_proof' => 'required|mimes:jpeg,png,pdf|max:2048',
    ]);

    $tiket = Tiket::findOrFail($id);

    // Simpan bukti pembayaran ke folder public/payment_proofs
    if ($request->hasFile('payment_proof')) {
        $file = $request->file('payment_proof');
        $filename = 'proof_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('payment_proofs'), $filename);

        // Update data tiket
        $tiket->payment_proof = $filename;
        $tiket->status = 'confirmed'; // atau pending_review tergantung flow kamu
        $tiket->save();
    }

    return redirect()->route('tiket.my')->with('success', 'Bukti pembayaran berhasil diunggah!');
}
    public function create($id)
    {
        $event = Event::findOrFail($id);
        return view('tiket.create', compact('event'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'jumlah' => 'required|integer|min:1|max:10',
            'metode_pembayaran' => 'required|in:bank_transfer,qris,ewallet',
        ]);

        $event = Event::findOrFail($data['event_id']);

        $tiket = Tiket::create([
            'event_id' => $event->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone'] ?? null,
            'quantity' => $data['jumlah'],
            'total_price' => $event->price * $data['jumlah'],
            'payment_method' => $data['metode_pembayaran'],
            'status' => 'pending',
            'ticket_code' => strtoupper(uniqid('TKT')),
        ]);

        return redirect()->route('tiket.success', $tiket->id)
            ->with('success', '✅ Tiket berhasil dipesan! Silakan lanjutkan pembayaran.');
    }

    public function success($id)
    {
        $tiket = Tiket::with('event')->findOrFail($id);
        return view('tiket.success', compact('tiket'));
    }

    public function konfirmasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update(['status' => 'paid']);
        return redirect()->route('tiket.final', $id)->with('success', '✅ Pembayaran berhasil dikonfirmasi!');
    }

    public function final($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('tiket.final', compact('tiket'));
    }

    public function myTickets()
    {
        $user = Auth::user();
        if (!$user) abort(403, 'Unauthorized');
        $tikets = Tiket::where('email', $user->email)->latest()->get();
        return view('tiket.my', compact('tikets'));
    }

    public function listAll()
    {
        $tikets = Tiket::with('event')->latest()->get();
        return view('admin.tiket.index', compact('tikets'));
    }

    public function adminKonfirmasi($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update(['status' => 'paid']);
        return back()->with('success', '✅ Tiket berhasil dikonfirmasi oleh admin!');
    }

    public function dummyBayar($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->update(['status' => 'paid']);
        return back()->with('success', '✅ Tiket berhasil dibayar (dummy).');
    }

    public function formUploadBukti($id)
    {
        $tiket = Tiket::findOrFail($id);
        if ($tiket->status !== 'pending') {
            return back()->with('error', '❌ Bukti hanya bisa diunggah untuk tiket yang belum dibayar.');
        }
        return view('tiket.upload', compact('tiket'));
    }

    public function daftarVerifikasi()
    {
        $tikets = Tiket::with('event')
            ->where('status', 'menunggu_verifikasi')
            ->latest()
            ->get();

        return view('admin.tiket.verifikasi', compact('tikets'));
    }

    public function tolakVerifikasi($id)
    {
        $tiket = Tiket::findOrFail($id);

        if ($tiket->status !== 'menunggu_verifikasi') {
            return back()->with('error', '❌ Tiket tidak dalam status verifikasi.');
        }

        if ($tiket->payment_proof_path && Storage::exists($tiket->payment_proof_path)) {
            Storage::delete($tiket->payment_proof_path);
        }

        $tiket->update([
            'status' => 'pending',
            'payment_proof_path' => null,
        ]);

        return back()->with('success', '⚠️ Bukti pembayaran ditolak dan status dikembalikan ke pending.');
    }
}
