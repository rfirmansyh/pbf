<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function budidayas(){
        return $this->hasMany('App\Budidaya', 'owned_by_uid');
    }
    public function productions(){
        return $this->hasOne('App\Production', 'updated_by_uid');
    }
    public function production_makers(){
        return $this->hasOne('App\Production', 'maked_by_uid');
    }
    // if pekerja
    public function work_on() {
        return $this->belongsTo('App\User', 'manager_id');
    }
    public function maintance_on(){
        return $this->hasOne('App\Budidaya', 'maintenance_by_uid');
    }

    public function workers() {
        return $this->hasMany('App\User', 'manager_id');
    }

    public function posts() {
        return $this->hasMany('App\Post', 'created_by_uid');
    }

}
