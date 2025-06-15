@extends('layouts.app')

@section('content')
<style>
    .form-wrapper {
        max-width: 480px;
        margin: 2rem auto;
        padding: 1.5rem;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        font-family: Arial, sans-serif;
    }

    .form-wrapper h2 {
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 0.3rem;
        color: #333;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.5rem;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .form-submit {
        margin-top: 1rem;
    }

    .form-submit button {
        width: 100%;
        padding: 0.6rem;
        background-color: #007bff;
        color: white;
        font-weight: 600;
        font-size: 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .form-submit button:hover {
        background-color: #0056b3;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 0.75rem;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 1rem;
    }
</style>

<div class="form-wrapper">
    <h2>Pesan Tiket: {{ $event->title }}</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tiket.store') }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">

        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Nomor HP (opsional):</label>
            <input type="text" name="phone">
        </div>

        <div class="form-group">
            <label>Jumlah Tiket:</label>
            <input type="number" name="jumlah" min="1" required>
        </div>

        <div class="form-group">
            <label>Metode Pembayaran:</label>
            <select name="metode_pembayaran" required>
                <option value="" disabled selected>Pilih metode...</option>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="qris">QRIS / Gopay</option>
                <option value="ewallet">OVO</option>
                <option value="ewallet">Dana</option>
            </select>
        </div>

        <div class="form-submit">
            <button type="submit">✅ Pesan Tiket Sekarang</button>
        </div>
    </form>
</div>
@endsection
