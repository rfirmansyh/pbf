<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';

    public function peminjaman() {
        return $this->belongsTo('App\Peminjaman');
    }

    public function admin() {
        return $this->belongsTo('App\User', 'admin_id');
    }
}
