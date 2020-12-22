<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function created_by(){
        return $this->belongsTo('App\User', 'created_by_uid');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
