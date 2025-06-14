<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    // Relasi ke model kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriTiket::class, 'kategori_id');
    }

    // Kolom yang bisa diisi saat create/update
    protected $fillable = [
        'nama', 
        'deskripsi', 
        'lokasi', 
        'tanggal', 
        'waktu', 
        'harga', 
        'gambar', 
        'kategori_id'
    ];
}
