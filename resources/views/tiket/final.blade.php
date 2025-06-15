@extends('layouts.app')

@section('content')
<div class="container max-w-xl mx-auto p-6 bg-white shadow rounded mt-6 text-center">
    <h2 class="text-2xl font-bold text-green-600 mb-4">✅ Pembayaran Berhasil!</h2>
    
    <p class="text-gray-700 mb-3">Terima kasih, pembayaran tiket kamu sudah dikonfirmasi.</p>

    <div class="bg-gray-100 rounded p-4 text-left mb-4">
        <p><strong>Nama:</strong> {{ $tiket->name }}</p>
        <p><strong>Acara:</strong> {{ $tiket->event->title }}</p>
        <p><strong>Kode Tiket:</strong> {{ $tiket->ticket_code }}</p>
        <p><strong>Status:</strong> <span class="text-green-600 font-bold">{{ ucfirst($tiket->status) }}</span></p>
    </div>

    <a href="{{ route('tiket.my') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        🎫 Lihat Tiket Saya
    </a>
</div>
@endsection
