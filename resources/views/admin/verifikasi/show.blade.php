@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9fafb;
    }

    .container {
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 24px;
    }

    .card {
        background-color: #fff;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .card p {
        margin-bottom: 10px;
        color: #374151;
    }

    .card strong {
        color: #111827;
    }

    .text-status {
        font-weight: 600;
    }

    .text-yellow {
        color: #d97706;
    }

    .text-green {
        color: #16a34a;
    }

    .text-red {
        color: #dc2626;
    }

    .bukti-img {
        margin-top: 12px;
        max-width: 250px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
    }

    .btn-group {
        margin-top: 24px;
    }

    .btn {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
        margin-right: 12px;
    }

    .btn-green {
        background-color: #22c55e;
    }

    .btn-green:hover {
        background-color: #16a34a;
    }

    .btn-red {
        background-color: #ef4444;
    }

    .btn-red:hover {
        background-color: #dc2626;
    }

    form {
        display: inline;
    }
</style>

<div class="container">
    <h1>Detail Tiket User</h1>

    <div class="card">
        <p><strong>Nama User:</strong> {{ $tiket->user->name }}</p>
        <p><strong>Email:</strong> {{ $tiket->user->email }}</p>
        <p><strong>Event:</strong> {{ $tiket->event->title }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $tiket->quantity }}</p>
        <p><strong>Status:</strong>
            <span class="text-status
                {{ $tiket->status === 'menunggu_verifikasi' ? 'text-yellow' : 
                    ($tiket->status === 'sudah_dibayar' ? 'text-green' : 'text-red') }}">
                {{ ucfirst(str_replace('_', ' ', $tiket->status)) }}
            </span>
        </p>
        <p><strong>Bukti Pembayaran:</strong><br>
            @if ($tiket->bukti_pembayaran)
                <img src="{{ asset('storage/' . $tiket->bukti_pembayaran) }}" alt="Bukti" class="bukti-img">
            @else
                <span class="text-red">Belum ada</span>
            @endif
        </p>

        <div class="btn-group">
            <form action="{{ route('admin.tiket.konfirmasi', $tiket->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-green">✅ Konfirmasi</button>
            </form>
            <form action="{{ route('admin.tiket.tolak', $tiket->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-red">❌ Tolak</button>
            </form>
        </div>
    </div>
</div>

@endsection
