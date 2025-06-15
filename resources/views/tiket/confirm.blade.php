@extends('layouts.app')

@section('content')
<div class="container max-w-xl mx-auto p-6 bg-white shadow rounded mt-6">
    <h2 class="text-2xl font-bold text-yellow-600 mb-4">🔁 Konfirmasi Pembayaran</h2>

    <p class="mb-4">Silakan transfer sesuai total harga dan upload bukti pembayaran.</p>

    <p>Nama: {{ $tiket->name }}</p>
    <p>Total Harga: Rp {{ number_format($tiket->total_price, 0, ',', '.') }}</p>

    {{-- Tambahkan form upload bukti jika kamu ingin fitur upload file --}}
</div>
@endsection
