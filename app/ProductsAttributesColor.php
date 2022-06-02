<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributesColor extends Model
{
    protected $table = "products_attributes_color";
    /*public function attributeColors() {
        return $this->hasMany('App\AttributeColors', 'attribute_id');
    }*/

    /*public function attributes() {
        return $this->belongsTo('App\Product', 'id');
    }*/

    public function getAvailableQtyAttribute()
    {
        $max_cart_qty = $this->color_stock;
        if($this->max_cart_qty != 0 && $this->max_cart_qty < $this->color_stock){
          $max_cart_qty = $this->max_cart_qty;
        }
        return $max_cart_qty;
    }

}
