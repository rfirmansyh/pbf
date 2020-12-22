<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kumbung extends Model
{
    public function budidaya(){
        return $this->belongsTo('App\Budidaya');
    }
    public function jamur(){
        return $this->belongsTo('App\Jamur');
    }
    public function productions(){
        return $this->hasMany('App\Production');
    }

}
