<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $table = "products_attributes";
    /*public function attributeColors() {
        return $this->hasMany('App\AttributeColors', 'attribute_id');
    }*/

    /*public function attributes() {
        return $this->belongsTo('App\Product', 'id');
    }*/

}
