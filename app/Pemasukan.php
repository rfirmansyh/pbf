<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    public function keuangan() {
        return $this->belongsTo('App\Keuangan');
    }
    public function panen() {
        return $this->hasOne('App\Panen');
    }

}
