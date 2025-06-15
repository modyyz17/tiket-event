@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🧾 Daftar Tiket</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Event</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tikets as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>{{ $t->event->title }}</td>
                    <td>{{ ucfirst($t->status) }}</td>
                    <td>
                        @if($t->payment_proof)
                            <a href="{{ asset('storage/' . $t->payment_proof) }}" target="_blank">📎 Lihat</a>
                        @else
                            ❌
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.tiket.show', $t->id) }}">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
