<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
   // App\Models\Tiket.php
protected $fillable = ['user_id', 'event_id', 'payment_proof', 'status'];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
