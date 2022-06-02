<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    protected $table = 'orders_details';

    public function order() {
        return $this->belongsTo('\App\Order');
    }

    public function product() {
        return $this->belongsTo('\App\Product');
    }

    public function sliderImages() {
        return $this->hasMany('\App\CategorySlider','color_id','color_id');
    }
}
