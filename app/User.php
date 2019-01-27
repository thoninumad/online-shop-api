<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'roles', 'address', 'city_id', 'province_id', 'phone',
        'avatar', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function generateToken() {
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }

    public function province() {
        return $this->belongsTo('\App\Province');
    }

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function orders() {
        return $this->hasMany('\App\Order');
    }
}
