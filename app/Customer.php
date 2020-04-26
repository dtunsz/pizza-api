<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'orderId', 'name', 'email', 'phone', 'houseNumber', 'streetName', 'city', 'orderPriceEur', 'orderPriceUsd'
    ];

    // protected $guarded = [];

    public function orders(){
        return $this->hasMany('App\Order', 'orderId', 'orderId');
    }
}
