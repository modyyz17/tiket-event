@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9fafb;
    }

    .success-container {
        max-width: 480px;
        margin: 60px auto;
        padding: 24px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
        text-align: center;
    }

    .success-title {
        font-size: 24px;
        font-weight: bold;
        color: #16a34a;
        margin-bottom: 16px;
    }

    .success-text {
        color: #374151;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .ticket-details {
        background-color: #f3f4f6;
        border-radius: 8px;
        padding: 16px;
        text-align: left;
        margin-bottom: 24px;
        color: #1f2937;
        font-size: 14px;
    }

    .ticket-details p {
        margin: 8px 0;
    }

    .btn-view-ticket {
        display: inline-block;
        background-color: #2563eb;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .btn-view-ticket:hover {
        background-color: #1e40af;
    }
</style>

<div class="success-container">
    <h2 class="success-title">✅ Pembayaran Berhasil!</h2>
    
    <p class="success-text">Terima kasih, pembayaran tiket kamu sudah dikonfirmasi.</p>

    <div class="ticket-details">
        <p><strong>Nama:</strong> {{ $tiket->name }}</p>
        <p><strong>Acara:</strong> {{ $tiket->event->title }}</p>
        <p><strong>Kode Tiket:</strong> {{ $tiket->ticket_code }}</p>
        <p><strong>Status:</strong> <span style="color:#16a34a; font-weight:bold;">{{ ucfirst($tiket->status) }}</span></p>
    </div>

    <a href="{{ route('tiket.my') }}" class="btn-view-ticket">🎫 Lihat Tiket Saya</a>
</div>
@endsection
