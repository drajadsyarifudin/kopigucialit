<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $incrementing = false; 

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
