<<<<<<< HEAD
<h2>Daftar Tiket</h2>

<a href="{{ route('tiket.create') }}">Tambah Tiket Baru</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tiket as $t)
        <tr>
            <td>{{ $t->nama }}</td>
            <td>{{ $t->harga }}</td>
            <td>{{ $t->kategori->nama }}</td>
            <td>{{ $t->tanggal }}</td>
            <td>{{ $t->waktu }}</td>
            <td>
                <a href="#">Edit</a> |
                <a href="#">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-5xl p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Tiket</h2>

    <table class="w-full border text-left text-sm">
        <thead>
            <tr class="bg-blue-100">
                <th class="p-2">Nama</th>
                <th class="p-2">Event</th>
                <th class="p-2">Email</th>
                <th class="p-2">Jumlah</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tikets as $tiket)
                <tr class="border-t">
                    <td class="p-2">{{ $tiket->name }}</td>
                    <td class="p-2">{{ $tiket->event->title }}</td>
                    <td class="p-2">{{ $tiket->email }}</td>
                    <td class="p-2">{{ $tiket->quantity }}</td>
                    <td class="p-2">
                        <span class="text-{{ $tiket->status === 'paid' ? 'green' : 'yellow' }}-600">
                            {{ ucfirst($tiket->status) }}
                        </span>
                    </td>
                    <td class="p-2">
                        @if ($tiket->status !== 'paid')
                            <form action="{{ route('admin.tiket.konfirmasi', $tiket->id) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Konfirmasi</button>
                            </form>
                        @else
                            <span class="text-green-700">Terkonfirmasi</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

