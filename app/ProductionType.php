<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionType extends Model
{
    public function productions(){
        return $this->hasMany('App\Production');
    }
}
