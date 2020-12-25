<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    public function books() {
        return $this->hasMany('App\Book');
    }
}
