<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/','Restaurants@fetch');

Auth::routes();
Route::group(['middleware' => 'web'], function () {

    Route::get('/order-status', function () {
        return view('order-status');
    });

    Route::get('/dashboard', function () {
        return view('dashboard/dashboard');
    });

    Route::get('/restaurant', function () {
        return view('restaurant');
    });

    Route::get('dashboard','Restaurants@read');

    Route::get('register-restaurant/success', function () {
        return view('restaurant/success');
    });

    Route::get('register-restaurant', function () {
        return view('restaurant/register');
    });

    Route::get('dashboard/categories', function () {
        return view('dashboard/categories');
    });

    Route::post('submitRestaurant','Restaurants@save');
    Route::post('approveRestaurant','Restaurants@approve');

    Route::get('dashboard/orders','OrdersController@read');

    Route::get('dashboard/products/add-product', function () {
        return view('dashboard/add-product');
    });

    Route::post('dashboard/products/sumbitProduct','Products@save');
    Route::get('dashboard/products','Products@read');
    Route::post('dashboard/deleteProduct','Products@delete');

    Route::post('dashboard/submitCategory','CategoriesController@save');
    //Route::get('dashboard/categories','CategoriesController@read');

    Route::get('dashboard/settings', function () {
        return view('dashboard/settings');
    });
    Route::get('dashboard/products/edit-product', 'Products@find');
    Route::post('dashboard/products/update-product','Products@update');

    Route::get('/{restaurantName}','Products@getProducts');

    Route::get('/add-to-cart/{restaurantName}/{id}', 'Products@addToCart');

    Route::get('/remove-from-cart/{restaurantName}/{id}','Products@removeFromCart');
    Route::get('/{restaurantName}/order','OrdersController@createOrder');

    Route::post('updateStatus','OrdersController@updateStatus');
    Route::post('createAllergy','Products@createAllergy');
    Route::post('addAllergyToProduct', 'Products@addAllergyToProduct');

    Route::get('/dashboard/categories','CategoriesController@read');

    Route::get('/1/1','Restaurants@orderByPriceDesc');
    Route::get('/2/2','Restaurants@orderByPriceDesc');

    Route::post('review/{{restaurantId}}','Restaurants@rateRestaurant');
});