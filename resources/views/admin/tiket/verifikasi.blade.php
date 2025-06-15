@extends('layouts.app')

@section('content')
<div class="container max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold text-yellow-600 mb-4">📩 Verifikasi Bukti Pembayaran</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @forelse ($tikets as $tiket)
        <div class="border-b pb-4 mb-4">
            <p><strong>Nama:</strong> {{ $tiket->name }}</p>
            <p><strong>Email:</strong> {{ $tiket->email }}</p>
            <p><strong>Event:</strong> {{ $tiket->event->title ?? 'Event tidak ditemukan' }}</p>
            <p><strong>Metode Bayar:</strong> {{ ucfirst($tiket->payment_method) }}</p>
            <p><strong>Jumlah:</strong> {{ $tiket->quantity }} tiket</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($tiket->total_price, 0, ',', '.') }}</p>

            @if ($tiket->payment_proof_path)
                <p><strong>Bukti Pembayaran:</strong></p>
                <a href="{{ asset(Storage::url($tiket->payment_proof_path)) }}" target="_blank">
                    <img src="{{ asset(Storage::url($tiket->payment_proof_path)) }}" alt="Bukti" class="w-40 border rounded shadow">
                </a>
            @endif

            <form action="{{ route('admin.tiket.konfirmasi', $tiket->id) }}" method="POST" class="inline-block mt-3 mr-2">
                @csrf
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">✔ Konfirmasi</button>
            </form>

            <form action="{{ route('admin.tiket.tolak', $tiket->id) }}" method="POST" class="inline-block mt-3">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">✖ Tolak</button>
            </form>
        </div>
    @empty
        <p class="text-gray-600 italic">Tidak ada tiket yang menunggu verifikasi.</p>
    @endforelse
</div>
@endsection
