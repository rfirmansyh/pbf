<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kebutuhan extends Model
{
    public function kebutuhanType(){
        return $this->belongsTo('App\KebutuhanType');
    }
    public function pengeluaran(){
        return $this->belongsTo('App\Pengeluaran');
    }
}
