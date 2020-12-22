<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budidaya extends Model
{
    public function owned_by(){
        return $this->belongsTo('App\User', 'owned_by_uid');
    }
    public function maintenance_by() {
        return $this->belongsTo('App\User', 'maintenance_by_uid');
    }
    public function kumbungs(){
        return $this->hasMany('App\Kumbung');
    }

}
