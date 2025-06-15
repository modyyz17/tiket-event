@extends('layouts.app')

@section('content')
<style>
    .upload-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 24px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .upload-container h2 {
        font-size: 24px;
        font-weight: bold;
        color: #D97706;
        margin-bottom: 16px;
    }

    .upload-container p {
        color: #4B5563;
        margin-bottom: 16px;
    }

    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 16px;
    }

    .alert-error {
        background-color: #FECACA;
        color: #991B1B;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 16px;
    }

    label {
        display: block;
        font-weight: 500;
        margin-bottom: 6px;
        color: #374151;
    }

    .form-group {
        margin-bottom: 24px;
    }

    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #D1D5DB;
        border-radius: 6px;
        background-color: #F9FAFB;
        font-size: 14px;
        cursor: pointer;
    }

    .error-message {
        color: #DC2626;
        font-size: 13px;
        margin-top: 4px;
    }

    button {
        background-color: #F59E0B;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    button:hover {
        background-color: #D97706;
    }
</style>

<div class="upload-container">
    <h2>📤 Upload Bukti Pembayaran</h2>

    <p>Silakan upload bukti pembayaran untuk tiket event <strong>{{ $tiket->event->title }}</strong>.</p>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('tiket.upload.kirim', $tiket->id) }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="payment_proof">Upload Bukti (jpg, png, pdf)</label>
            <input type="file" name="payment_proof" id="payment_proof" required>
            @error('payment_proof')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">
            🚀 Kirim Bukti Pembayaran
        </button>
    </form>
</div>
@endsection
