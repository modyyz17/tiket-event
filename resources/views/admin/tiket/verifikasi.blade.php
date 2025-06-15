@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9fafb;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1f2937;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 6px;
    }

    .alert-error {
        background-color: #fee2e2;
        color: #991b1b;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 6px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    thead {
        background-color: #e5e7eb;
    }

    th, td {
        padding: 12px;
        border: 1px solid #d1d5db;
        text-align: left;
    }

    th {
        color: #374151;
    }

    td {
        color: #4b5563;
    }

    img {
        max-height: 100px;
        border-radius: 4px;
    }

    .btn-confirm {
        background-color: #16a34a;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        margin-right: 5px;
        cursor: pointer;
    }

    .btn-reject {
        background-color: #dc2626;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-confirm:hover {
        background-color: #15803d;
    }

    .btn-reject:hover {
        background-color: #b91c1c;
    }

    form.inline {
        display: inline-block;
    }
</style>

<div class="container">
    <h2>Daftar Tiket Menunggu Verifikasi</h2>

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

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Event</th>
                <th>Bukti Bayar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tikets as $tiket)
            <tr>
                <td>{{ $tiket->user->name }}</td>
                <td>{{ $tiket->event->title }}</td>
                <td>
                    @if ($tiket->payment_proof)
                        <img src="{{ asset('storage/' . $tiket->payment_proof) }}" alt="Bukti Bayar">
                    @else
                        Belum Upload
                    @endif
                </td>
                <td>{{ $tiket->status }}</td>
                <td>
                    <form action="{{ route('admin.verifikasi.konfirmasi', $tiket->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-confirm">✔️ Konfirmasi</button>
                    </form>
                    <form action="{{ route('admin.verifikasi.tolak', $tiket->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-reject">❌ Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
