<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['payment_id', 'origin', 'destination', 'courier', 'status','resi'];
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
