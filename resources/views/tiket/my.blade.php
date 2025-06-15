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

    h2 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 24px;
        color: #111827;
    }

    .ticket-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .ticket-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease-in-out;
    }

    .ticket-card:hover {
        transform: translateY(-4px);
    }

    .ticket-info p {
        margin: 4px 0;
        font-size: 14px;
        color: #374151;
    }

    .ticket-info strong {
        color: #111827;
    }

    .status-paid {
        color: #10b981;
        font-weight: bold;
    }

    .status-pending {
        color: #f59e0b;
        font-weight: bold;
    }

    .status-pending_verification {
        color: #fbbf24;
        font-weight: bold;
    }

    .status-cancelled {
        color: #ef4444;
        font-weight: bold;
    }

    .ticket-actions {
        margin-top: 16px;
    }

    .ticket-actions a,
    .ticket-actions span {
        display: inline-block;
        padding: 8px 14px;
        font-size: 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
    }

    .btn-lihat {
        background-color: #2563eb;
        color: white;
    }

    .btn-bayar {
        background-color: #10b981;
        color: white;
    }

    .no-ticket {
        background-color: #f3f4f6;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        color: #6b7280;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 600px) {
        .ticket-card {
            padding: 16px;
        }

        .ticket-actions a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container">
    <h2>🎟️ Tiket Saya</h2>

    {{-- ✅ Flash Message --}}
    @if(session('success'))
        <div style="background-color: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if($tikets->count())
        <div class="ticket-grid">
            @foreach($tikets as $tiket)
                <div class="ticket-card">
                    <div>
                        <h3>{{ $tiket->event->title }}</h3>
                        <div class="ticket-info">
                            <p><strong>Jumlah:</strong> {{ $tiket->quantity }}</p>
                            <p><strong>Total:</strong> Rp{{ number_format($tiket->total_price, 0, ',', '.') }}</p>
                            <p><strong>Kode:</strong> {{ $tiket->ticket_code }}</p>
                            <p><strong>Status:</strong>
                                @if($tiket->status === 'paid')
                                    <span class="status-paid">Lunas</span>
                                @elseif($tiket->status === 'pending')
                                    <span class="status-pending">Menunggu Pembayaran</span>
                                @elseif($tiket->status === 'pending_verification')
                                    <span class="status-pending_verification">Menunggu Verifikasi</span>
                                @else
                                    <span class="status-cancelled">{{ ucfirst($tiket->status) }}</span>
                                @endif
                            </p>
                            <p><strong>Metode:</strong> {{ strtoupper($tiket->payment_method) }}</p>
                        </div>
                    </div>

                    <div class="ticket-actions">
                        @if($tiket->status === 'paid')
                            <a href="{{ route('tiket.final', $tiket->id) }}" class="btn-lihat">📄 Lihat Tiket</a>
                        @elseif($tiket->status === 'pending')
                            <a href="{{ route('tiket.upload.form', $tiket->id) }}" class="btn-bayar">💳 Lanjutkan Pembayaran</a>
                        @elseif($tiket->status === 'pending_verification')
                            <span class="btn-lihat" style="background-color:#fef3c7; color:#92400e; cursor: default;">⏳ Menunggu Verifikasi</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="no-ticket">Kamu belum membeli tiket apa pun.</p>
    @endif
</div>
@endsection
