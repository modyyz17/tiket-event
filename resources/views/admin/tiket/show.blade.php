@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📄 Detail Tiket</h2>

    <p><strong>Nama:</strong> {{ $tiket->name }}</p>
    <p><strong>Event:</strong> {{ $tiket->event->title }}</p>
    <p><strong>Status:</strong> {{ ucfirst($tiket->status) }}</p>

    @if ($tiket->payment_proof)
        <p><strong>Bukti Pembayaran:</strong></p>
        <img src="{{ asset('storage/' . $tiket->payment_proof) }}" width="300" style="border-radius:8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    @else
        <p><strong>Bukti Pembayaran:</strong> Belum ada</p>
    @endif

    <form method="POST" action="{{ route('admin.tiket.update', $tiket->id) }}">
        @csrf
        <label>Status</label>
        <select name="status">
            <option value="pending" {{ $tiket->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="dibayar" {{ $tiket->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
            <option value="confirmed" {{ $tiket->status == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
        </select>
        <button type="submit">💾 Simpan</button>
    </form>
</div>
@endsection
