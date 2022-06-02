<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';

    public function products() {
        return $this->hasMany('App\Product');
    }
}
