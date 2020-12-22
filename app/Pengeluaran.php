<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    public function keuangan() {
        return $this->belongsTo('App\Keuangan');
    }
    public function kebutuhan() {
        return $this->hasOne('App\Kebutuhan');
    }

}
