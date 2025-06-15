@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        max-width: 960px;
        margin: 40px auto;
        padding: 20px;
    }

    h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 24px;
        color: #111827;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .card {
        background-color: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: default;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    .card h2 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
    }

    .bg-green {
        background-color: #d1fae5;
        color: #065f46;
    }

    .bg-red {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .bg-yellow {
        background-color: #fef9c3;
        color: #92400e;
    }
</style>

<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="grid">
        <div class="card">
            <h2>Total Tiket</h2>
            <p>{{ $totalTiket }}</p>
        </div>

        <div class="card bg-green">
            <h2>Sudah Bayar</h2>
            <p>{{ $tiketSudahBayar }}</p>
        </div>

        <div class="card bg-red">
            <h2>Belum Bayar</h2>
            <p>{{ $tiketBelumBayar }}</p>
        </div>

        {{-- 🟡 Tambahan Card untuk Menuju Halaman Verifikasi Tiket --}}
        <a href="{{ route('admin.verifikasi.index') }}" class="card bg-yellow card-link">
            <h2>Verifikasi Pembayaran</h2>
            <p>Lihat Daftar</p>
        </a>
        <a href="{{ route('admin.events.index') }}" class="card bg-yellow card-link">
            <h2>Daftar Event</h2>
            <p>Lihat Daftar Event</p>
        </a>
    </div>
</div>
@endsection
