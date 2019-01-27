<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'category_product';
    protected $fillable = [
        'product_id', 'category_id'
    ];
}
