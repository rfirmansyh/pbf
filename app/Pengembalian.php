<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';

    public function peminjaman() {
        return $this->belongsTo('App\Peminjaman');
    }

    public function book() {
        return $this->belongsTo('App\Book');
    }

    public function member() {
        return $this->belongsTo('App\User', 'member_id');
    }

    public function admin() {
        return $this->belongsTo('App\User', 'admin_id');
    }
}
