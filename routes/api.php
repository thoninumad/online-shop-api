<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    // public
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::get('categories/random/{count}', 'CategoryController@random');
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/slug/{slug}', 'CategoryController@slug');

    Route::get('products/top/{count}', 'ProductController@top');
    Route::get('products', 'ProductController@index');
    Route::get('products/slug/{slug}', 'ProductController@slug');
    Route::get('products/search/{keyword}', 'ProductController@search');

    Route::get('provinces', 'ShopController@provinces');
    Route::get('cities', 'ShopController@cities');
    Route::get('couriers', 'ShopController@couriers');

    // private
    Route::middleware('auth:api')->group(function() {
        Route::post('logout', 'AuthController@logout');
        Route::post('shipping', 'ShopController@shipping');
        Route::post('services', 'ShopController@services');
        Route::post('payment', 'ShopController@payment');
        Route::post('update-profile', 'UserController@updateProfile');
        Route::post('update-password', 'UserController@updatePassword');
        Route::get('my-order', 'ShopController@myOrder');
    });
});
