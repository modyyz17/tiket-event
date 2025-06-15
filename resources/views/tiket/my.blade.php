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
        padding-top: 40px;
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

    .btn-menunggu {
        background-color: #fef3c7;
        color: #92400e;
        cursor: not-allowed;
        border: 1px solid #fde68a;
    }

    .no-ticket {
        background-color: #f3f4f6;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        color: #6b7280;
    }

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

    {{-- 🔙 Tombol Kembali --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('dashboard') }}" style="display: inline-block; background-color: #e5e7eb; color: #374151; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            ⬅️ Kembali ke Beranda
        </a>
    </div>

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
                                @php
                                    $status = strtolower($tiket->status);
                                @endphp
                                @if(in_array($status, ['paid', 'lunas', 'sudah_dibayar']))
                                    <span style="color:#10b981; font-weight:bold;">Lunas</span>
                                @elseif(in_array($status, ['pending', 'menunggu pembayaran', 'belum_bayar']))
                                    <span style="color:#d97706; font-weight:bold;">Menunggu Pembayaran</span>
                                @elseif(in_array($status, ['menunggu_verifikasi', 'pending_verification']))
                                    <span style="color:#eab308; font-weight:bold;">Menunggu Verifikasi</span>
                                @else
                                    <span style="color:#ef4444; font-weight:bold;">{{ ucfirst($status) }}</span>
                                @endif
                            </p>
                            <p><strong>Metode:</strong> {{ strtoupper($tiket->payment_method) }}</p>
                        </div>
                    </div>

                    <div class="ticket-actions">
                        @if(in_array($status, ['paid', 'lunas', 'sudah_dibayar']))
                            <a href="{{ route('tiket.final', $tiket->id) }}" class="btn-lihat">📄 Lihat Tiket</a>
                        @elseif(in_array($status, ['pending', 'menunggu pembayaran', 'belum_bayar']))
                            <a href="{{ route('tiket.upload.form', $tiket->id) }}" class="btn-bayar">💳 Lanjutkan Pembayaran</a>
                        @elseif(in_array($status, ['menunggu_verifikasi', 'pending_verification']))
                            <span class="btn-menunggu">⏳ Menunggu Verifikasi</span>
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
