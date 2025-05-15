<!-- resources/views/admin/events.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Kelola Event</h1>

    <!-- Menampilkan pesan jika ada aksi berhasil -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk membuka form tambah event -->
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addEventModal">Tambah Event</button>

    <!-- Daftar Event -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Event</th>
                <th>Tanggal Event</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}</td>
                    <td>
                        <!-- Form untuk menghapus event -->
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal untuk tambah event -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Event</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Event</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
