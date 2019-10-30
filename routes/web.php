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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
})->middleware('auth');

Route::get('dashboard','Restaurants@read');

Route::get('register-restaurant/success', function () {
    return view('restaurant/success');
})->middleware('auth');

Route::get('register-restaurant', function () {
    return view('restaurant/register');
})->middleware('auth');

Route::post('submitRestaurant','Restaurants@save');
Route::post('approveRestaurant','Restaurants@approve');

Route::get('dashboard/orders', function () {
    return view('dashboard/orders');
})->middleware('auth');

Route::get('dashboard/products', function () {
    return view('dashboard/products');
})->middleware('auth');

Route::get('dashboard/products/add-product', function () {
    return view('dashboard/add-product');
})->middleware('auth');

Route::post('dashboard/products/sumbitProduct','Products@save');
Route::get('dashboard/products','Products@read');
Route::post('dashboard/deleteProduct','Products@delete');

Route::get('dashboard/settings', function () {
    return view('dashboard/settings');
})->middleware('auth');
Route::get('dashboard/products/edit-product', 'Products@find');
Route::post('dashboard/products/update-product','Products@update');
