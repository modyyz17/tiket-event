<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

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
        'payment_proof_path',
    ];

    // Relasi ke tabel users
    // app/Models/Tiket.php
public function user() {
    return $this->belongsTo(User::class, 'email', 'email');
}

    // Relasi ke tabel events
   public function event() {
    return $this->belongsTo(Event::class, 'event_id');
}
}
