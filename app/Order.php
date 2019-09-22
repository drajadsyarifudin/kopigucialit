<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['id','invoice', 'customer_id', 'user_id', 'total'];

    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
