@extends('layouts.app')

@section('content')
<div class="container max-w-4xl mx-auto mt-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">📋 Daftar Pembayaran Tiket</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse">
        <thead class="bg-gray-200 text-gray-800">
            <tr>
                <th class="p-2 text-left">User</th>
                <th class="p-2 text-left">Event</th>
                <th class="p-2 text-left">Jumlah</th>
                <th class="p-2 text-left">Total</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Bukti</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tikets as $tiket)
                <tr class="border-b">
                    <td class="p-2">{{ $tiket->user->name }}</td>
                    <td class="p-2">{{ $tiket->event->title }}</td>
                    <td class="p-2">{{ $tiket->quantity }}</td>
                    <td class="p-2">Rp{{ number_format($tiket->total_price, 0, ',', '.') }}</td>
                    <td class="p-2 font-semibold {{ $tiket->status === 'waiting' ? 'text-yellow-600' : ($tiket->status === 'confirmed' ? 'text-green-600' : 'text-gray-600') }}">
                        {{ ucfirst($tiket->status) }}
                    </td>
                    <td class="p-2">
                        @if ($tiket->payment_proof)
                            <a href="{{ asset('storage/bukti_pembayaran/' . $tiket->payment_proof) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                        @else
                            <span class="text-gray-400 italic">Belum ada</span>
                        @endif
                    </td>
                    <td class="p-2">
                        @if ($tiket->status === 'waiting')
                            <form action="{{ route('admin.confirm_payment', $tiket->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pembayaran ini?')">
                                @csrf
                                @method('PUT')
                                <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">✔ Konfirmasi</button>
                            </form>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
