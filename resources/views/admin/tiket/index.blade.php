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