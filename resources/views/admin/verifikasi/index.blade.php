@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7fafc;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 20px;
    }

    .btn-kembali {
        background-color: #4a5568;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
        margin-bottom: 20px;
    }

    .card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    th {
        background-color: #edf2f7;
        font-weight: bold;
        color: #2d3748;
    }

    a {
        color: #3182ce;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    .text-center {
        text-align: center;
    }

    .no-data {
        padding: 20px;
        color: #718096;
    }
</style>

<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="btn-kembali">⬅️ Kembali ke Dashboard</a>
    
    <h1>Tiket Menunggu Verifikasi</h1>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Event</th>
                    <th>Jumlah Tiket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tiket as $t)
                <tr>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->event->title }}</td>
                    <td>{{ $t->quantity }}</td>
                    <td>
                        <a href="{{ route('admin.tiket.show', $t->id) }}">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center no-data">Tidak ada tiket menunggu verifikasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
