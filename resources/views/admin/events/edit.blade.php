@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 600px;
        margin: 40px auto;
        padding: 24px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 16px;
    }

    label {
        display: block;
        font-weight: 500;
        margin-bottom: 6px;
        color: #444;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select,
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .error-box {
        background-color: #ffe0e0;
        color: #cc0000;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #218838;
    }

    .image-preview {
        margin-top: 10px;
    }

    .image-preview img {
        height: 100px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .image-caption {
        font-size: 13px;
        color: #666;
        margin-bottom: 4px;
    }
</style>

<div class="container">
    <h2>✏️ Edit Event</h2>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul Event</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="category">
                <option value="konser" {{ $event->category == 'konser' ? 'selected' : '' }}>Konser</option>
                <option value="pameran" {{ $event->category == 'pameran' ? 'selected' : '' }}>Pameran</option>
                <option value="gameshow" {{ $event->category == 'gameshow' ? 'selected' : '' }}>Gameshow</option>
                <option value="seminar" {{ $event->category == 'seminar' ? 'selected' : '' }}>Seminar</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="date" value="{{ old('date', $event->date) }}">
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}">
        </div>

        <div class="form-group">
            <label for="price">Harga Tiket</label>
<input type="number" name="price" id="price" class="form-input" value="{{ old('price', $event->price) }}" required>

        </div>

        <div class="form-group">
            <label>Gambar Event</label>
            <input type="file" name="image">
            @if ($event->image)
                <div class="image-preview">
                    <p class="image-caption">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Gambar Event">
                </div>
            @endif
        </div>

        <button type="submit" class="btn-submit">Update Event</button>
    </form>
</div>
@endsection
