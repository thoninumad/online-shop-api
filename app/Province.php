<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;

    public function users() {
        return $this->hasMany('App\User');
    }
}
