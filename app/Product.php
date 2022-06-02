<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    
    public function attributes() {
        return $this->hasMany('App\ProductAttributes', 'product_id');
    }

    public function color_image() {
        return $this->hasMany('App\ColorImage', 'product_id');
    }

    public function order_details() {
        return $this->hasMany('\App\OrdersDetail');
    }

    public function category() {
        return $this->belongsTo('\App\Category');
    }

    public function collection() {
        return $this->belongsTo('App\Collection');
    }
}
