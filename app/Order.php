<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function details() {
        return $this->hasMany('\App\OrdersDetail', 'order_id');
    }

    public function customer() {
        return $this->belongsTo('\App\Customer');
    }
}
