<form action="{{ route('tiket.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input name="nama" type="text" placeholder="Nama"><br>

    <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br>

    <input name="lokasi" type="text" placeholder="Lokasi"><br>

    <input name="tanggal" type="date"><br>

    <input name="waktu" type="time"><br>

    <input name="harga" type="number" placeholder="Harga"><br>

    <input name="gambar" type="file"><br>

    <select name="kategori_id">
        @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->nama }}</option>
        @endforeach
    </select><br>

    <button type="submit">Simpan</button>
</form>
