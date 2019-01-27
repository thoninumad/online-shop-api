<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductResourceCollection;

class ProductController extends Controller
{
    public function top($count) {
        $criteria = Product::select('*')
          ->where('status', 'PUBLISH')
          ->orderBy('id', 'DESC')
          ->limit($count)
          ->get();

        return new ProductResourceCollection($criteria);
    }

    public function index() {
        $criteria = Product::where('status', 'PUBLISH')->paginate(12);
        return new ProductResourceCollection($criteria);
    }

    public function slug($slug) {
        $criteria = Product::where('slug', $slug)->first();
        return new ProductResource($criteria);
    }

    public function search($keyword) {
        $criteria = Product::select('*')
          ->where('name', 'LIKE', "%".$keyword."%")
          ->where('status', 'PUBLISH')
          ->orderBy('views', 'DESC')
          ->get();

        return new ProductResourceCollection($criteria);
    }
}
