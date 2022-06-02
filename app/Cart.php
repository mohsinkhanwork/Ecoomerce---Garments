<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    /*public function attributeColors() {
        return $this->hasMany('App\AttributeColors', 'attribute_id');
    }*/

    /*public function attributes() {
        return $this->belongsTo('App\Product', 'id');
    }*/

}
