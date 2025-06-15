<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone_number',
        'quantity',
        'total_price',
        'payment_method',
        'ticket_code',
        'status',
        'payment_proof_path', // tambahkan jika kamu menggunakan bukti pembayaran
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
