@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('dashboard') }}" class="btn-back">← Kembali ke Home</a>

    <h2 class="text-xl font-bold text-center mb-4">🎮 Daftar Event Gameshow</h2>

    <form action="{{ route('konser') }}" method="GET" class="search-form text-center mb-6">
        <input type="text" name="search" placeholder="Cari konser..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    <div class="card-grid">
        @forelse ($events as $event)
            <div class="concert-card">
                <img src="{{ asset('images/konser-default.jpg') }}" alt="Concert Image" class="concert-image">
                <div class="concert-body">
                    <div class="concert-title">{{ $event->title }}</div>
                    <div class="concert-info">📍 {{ $event->location }}</div>
                    <div class="concert-info">📅 {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</div>
                    <div class="concert-info">💵 Rp {{ number_format($event->price ?? 0, 0, ',', '.') }}</div>
                    <div class="concert-description">{{ $event->description }}</div>

                    <!-- Tombol beli tiket -->
                    <a href="{{ route('tiket.create', ['id' => $event->id]) }}" class="btn-ticket">
                        🎟️ Beli Tiket
                    </a>

                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Tidak ada event konser ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
