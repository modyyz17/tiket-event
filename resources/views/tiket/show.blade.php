@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 mt-10 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6 text-green-600">🎉 Tiket Berhasil Dipesan!</h2>

    <div class="bg-gray-100 p-4 rounded mb-4">
        <p><strong>Nama:</strong> {{ $tiket->name }}</p>
        <p><strong>Email:</strong> {{ $tiket->email }}</p>
        <p><strong>No HP:</strong> {{ $tiket->phone_number ?? '-' }}</p>
        <p><strong>Event:</strong> {{ $tiket->event->title }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $tiket->quantity }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($tiket->total_price, 0, ',', '.') }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ ucwords(str_replace('_', ' ', $tiket->payment_method)) }}</p>
        <p><strong>Kode Tiket:</strong> {{ $tiket->ticket_code }}</p>
        <p><strong>Status:</strong> <span class="text-yellow-600 font-semibold">{{ ucfirst($tiket->status) }}</span></p>
    </div>

    <div class="text-center">
        <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block mt-4">
            ⬅️ Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
