<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events'; // opsional, tapi aman ditulis
    protected $fillable = ['nama_event', 'lokasi', 'tanggal', 'kategori', 'gambar'];
}
