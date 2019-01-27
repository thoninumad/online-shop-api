<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'slug', 'description', 'producer', 'image', 'price', 'weight', 'stock', 'status'
    ];

    public function categories() {
        return $this->belongsToMany('\App\Category');
    }

    public function orders() {
        return $this->belongsToMany('\App\Order');
    }
}
