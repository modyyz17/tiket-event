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
        background-color: #ffffff;
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1f2937;
    }

    .btn-kembali {
        background-color: #6b7280;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        margin-right: 10px;
    }

    .btn-tambah {
        background-color: #3b82f6;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #e5e7eb;
        padding: 12px 16px;
        text-align: left;
    }

    th {
        background-color: #f3f4f6;
        color: #374151;
        font-weight: 600;
    }

    tr:nth-child(even) {
        background-color: #f9fafb;
    }

    .action-btn {
        text-decoration: none;
        margin-right: 10px;
        font-size: 14px;
    }

    .edit-btn {
        color: #2563eb;
    }

    .delete-btn {
        color: #dc2626;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .delete-btn:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h2>📅 Daftar Event</h2>

    <a href="{{ route('admin.dashboard') }}" class="btn-kembali">⬅️ Kembali ke Dashboard</a>
    <a href="{{ route('admin.events.create') }}" class="btn-tambah">+ Tambah Event</a>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ ucfirst($event->category) }}</td>
                <td>{{ $event->location }}</td>
                <td>Rp{{ number_format($event->price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="action-btn edit-btn">✏️ Edit</a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin hapus event ini?')">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
