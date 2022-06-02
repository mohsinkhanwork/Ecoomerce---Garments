<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function orders() {
        return $this->hasMany('\App\Order');
    }
}
