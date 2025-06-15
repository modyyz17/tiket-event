@extends('layouts.app')

@section('content')
<div class="container max-w-xl mx-auto p-6 bg-white shadow rounded mt-6">
    <h2 class="text-2xl font-bold text-yellow-600 mb-4">📤 Upload Bukti Pembayaran</h2>

    <p class="mb-4 text-gray-700">Silakan upload bukti pembayaran untuk tiket event <strong>{{ $tiket->event->title }}</strong>.</p>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('tiket.upload.konfirmasi', $tiket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="payment_proof" class="block font-medium text-gray-700 mb-1">Upload Bukti (jpg, png, pdf)</label>
            <input type="file" name="payment_proof" id="payment_proof" class="border border-gray-300 rounded w-full px-3 py-2" required>
            @error('payment_proof')
                <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
            🚀 Kirim Bukti Pembayaran
        </button>
    </form>
</div>
@endsection
