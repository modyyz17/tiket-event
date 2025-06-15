@extends('layouts.app')

@section('content')
<style>
    .profile-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #10b981;
        margin-bottom: 20px;
    }

    .profile-title {
        font-size: 28px;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .profile-role {
        font-size: 16px;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 30px;
    }

    .profile-info {
        text-align: left;
        margin-top: 20px;
    }

    .profile-field {
        margin-bottom: 16px;
        font-size: 16px;
    }

    .profile-field strong {
        display: inline-block;
        width: 160px;
        color: #374151;
    }

    .btn-edit, .btn-back {
        display: inline-block;
        margin: 15px 10px 0 10px;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s ease;
    }

    .btn-edit {
        background-color: #10b981;
        color: white;
    }

    .btn-edit:hover {
        background-color: #059669;
    }

    .btn-back {
        background-color: #f3f4f6;
        color: #1f2937;
        border: 1px solid #d1d5db;
    }

    .btn-back:hover {
        background-color: #e5e7eb;
    }
</style>

<div class="profile-container">
    {{-- Avatar Placeholder --}}
    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10b981&color=fff&size=120" alt="Avatar" class="profile-avatar">

    <h2 class="profile-title">{{ $user->name }}</h2>
    <p class="profile-role">{{ $user->role ?? 'Pengguna' }}</p>

    <div class="profile-info">
        <div class="profile-field">
            <strong>Email:</strong> {{ $user->email }}
        </div>

        <div class="profile-field">
            <strong>Terdaftar Sejak:</strong> {{ $user->created_at->format('d M Y') }}
        </div>

        <div class="profile-field">
            <strong>Peran:</strong> {{ $user->role ?? 'Pengguna' }}
        </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn-edit">✏️ Edit Profil</a>
    <a href="{{ route('tiket.my') }}" class="btn-back">📄 Riwayat Tiket</a>
    <a href="{{ url('dashboard') }}" class="btn-back">← Kembali ke Halaman</a>
</div>
@endsection
