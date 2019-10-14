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
});

Route::get('dashboard/orders', function () {
    return view('dashboard/orders');
});

Route::get('dashboard/products', function () {
    return view('dashboard/products');
});

Route::get('dashboard/products/add-product', function () {
    return view('dashboard/add-product');
});

Route::post('dashboard/products/sumbitProduct','Products@save');
Route::get('dashboard/products','Products@read');
Route::post('dashboard/deleteProduct','Products@delete');

Route::get('dashboard/settings', function () {
    return view('dashboard/settings');
});
Route::get('dashboard/products/edit-product', 'Products@find');
Route::post('dashboard/products/update-product','Products@update');
