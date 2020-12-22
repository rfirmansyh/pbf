<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    public function kumbung(){
        return $this->belongsTo('App\Kumbung');
    }
    public function usermake(){
        return $this->belongsTo('App\User', 'maked_by_uid');
    }
    public function user(){
        return $this->belongsTo('App\User', 'updated_by_uid');
    }
    public function productionType(){
        return $this->belongsTo('App\ProductionType');
    }
    public function keuangans() {
        return $this->hasMany('App\Keuangan');
    }

}
