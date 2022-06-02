<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    public function country() {
        return $this->belongsTo('\App\Country');
    }
    
    public function state() {
        return $this->belongsTo('\App\State');
    }
    public function city() {
        return $this->belongsTo('\App\City');
    }

}
