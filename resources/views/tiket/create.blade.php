@extends('layouts.app')

@section('content')
<style>
    .form-wrapper {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-wrapper h2 {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
    }

    .form-submit {
        margin-top: 1rem;
        text-align: center;
    }

    .form-submit button {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        width: 100%;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .form-submit button:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-wrapper">
    <h2>Pesan Tiket: {{ $event->title }}</h2>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 16px;">
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
