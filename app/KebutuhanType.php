<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KebutuhanType extends Model
{
    public function kebutuhans(){
        return $this->hasMany('App\Kebutuhan');
    }
}
