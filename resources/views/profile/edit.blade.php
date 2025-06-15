@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 720px;
        margin: 40px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 24px;
        color: #1f2937;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        background-color: #f9fafb;
    }

    input:focus {
        outline: none;
        border-color: #2563eb;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    }

    .btn-submit {
        background-color: #2563eb;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: #1d4ed8;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #111827;
        margin-top: 30px;
        margin-bottom: 10px;
        border-top: 1px solid #e5e7eb;
        padding-top: 20px;
    }

    .btn-back {
        display: inline-block;
        margin-bottom: 20px;
        color: #2563eb;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .btn-back:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
</style>

<div class="form-container">
    <a href="{{ route('profile.show') }}" class="btn-back">← Kembali ke Profil</a>

    <h2>Edit Profil</h2>

    {{-- Update nama dan email --}}
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <button type="submit" class="btn-submit">💾 Simpan Perubahan</button>
    </form>

    {{-- Form Ganti Password --}}
    <h2 class="section-title">Ganti Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Password Lama</label>
            <input type="password" name="current_password" id="current_password" required>
        </div>

        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit" class="btn-submit">🔒 Ubah Password</button>
    </form>

    <a href="{{ route('profile.show') }}" class="btn-back">← Kembali ke Profil</a>
</div>
@endsection
