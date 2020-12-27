<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    public function book() {
        return $this->belongsTo('App\Book');
    }

    public function member() {
        return $this->belongsTo('App\User', 'member_id');
    }

    public function admin() {
        return $this->belongsTo('App\User', 'admin_id');
    }

    public function pengembalian() {
        return $this->hasOne('App\Pengembalian');
    }
}
