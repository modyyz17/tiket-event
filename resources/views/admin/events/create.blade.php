@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9fafb;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 640px;
        margin: 40px auto;
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 24px;
        color: #2d3748;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #4a5568;
    }

    input[type="text"],
    input[type="number"],
    input[type="datetime-local"],
    textarea,
    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e0;
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #f7fafc;
        transition: border 0.3s ease;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: #3182ce;
        outline: none;
        background-color: white;
    }

    button {
        background-color: #2b6cb0;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2c5282;
    }
</style>

<div class="container">
    <h2>+ Tambah Event</h2>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div>
            <label>Judul Event</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Deskripsi</label>
            <textarea name="description" rows="3"></textarea>
        </div>

        <div>
            <label>Kategori</label>
            <select name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="konser">Konser</option>
                <option value="pameran">Pameran</option>
                <option value="gameshow">Game Show</option>
                <option value="seminar">Seminar</option>
            </select>
        </div>

        <div>
            <label>Tanggal & Waktu</label>
            <input type="datetime-local" name="date" required>
        </div>

        <div>
            <label>Lokasi</label>
            <input type="text" name="location" required>
        </div>

       <div class="mb-4">
    <label class="block font-medium">Harga Tiket</label>
    <input type="number" name="price" class="form-input" value="{{ old('price') }}" required>
</div>


         <div>
              <label class="block font-medium">Gambar Event</label>
            <input type="file" name="image" class="w-full">
        </div>

        <button type="submit">💾 Simpan Event</button>
    </form>
</div>

@endsection
