<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'orderId', 'productName', 'productPrice', 'quantity'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer', 'orderId', 'orderId');
    }
}
