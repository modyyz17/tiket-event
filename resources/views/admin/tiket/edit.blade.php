<form action="{{ route('admin.tiket.update', $tiket->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Status -->
    <select name="status" class="form-select">
        <option value="menunggu" {{ $tiket->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
        <option value="dibayar" {{ $tiket->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
    </select>

    <!-- Upload bukti pembayaran -->
    <label>Bukti Pembayaran</label>
    <input type="file" name="bukti_pembayaran" class="form-control">

    <!-- Tombol -->
    <button type="submit">Simpan</button>
</form>

<!-- Menampilkan gambar yang sudah ada -->
@if ($tiket->bukti_pembayaran)
    <p>Bukti saat ini:</p>
    <img src="{{ asset('storage/' . $tiket->bukti_pembayaran) }}" width="250">
@endif
