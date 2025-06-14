<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriTiket extends Model
{
    // Nama tabel secara eksplisit
    protected $table = 'kategori_tiket';

    // Relasi: satu kategori punya banyak tiket
    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'kategori_id');
    }

    // Kolom yang boleh diisi
    protected $fillable = ['nama'];
}
