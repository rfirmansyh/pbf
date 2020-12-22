<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    public function pemasukan(){
        return $this->belongsTo('App\Pemasukan');
    }
}
