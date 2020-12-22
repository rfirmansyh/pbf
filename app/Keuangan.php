<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    public function production() {
        return $this->belongsTo('App\Production');
    }
    public function pemasukans() {
        return $this->hasMany('App\Pemasukan');
    }
    public function pengeluarans() {
        return $this->hasMany('App\Pengeluaran');
    }

}
