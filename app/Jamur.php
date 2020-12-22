<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamur extends Model
{
    public function kumbung(){
        return $this->hasMany('App\Kumbung');
    }
}
