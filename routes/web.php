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

Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
});

Route::get('dashboard','Restaurants@read');

Route::get('register-restaurant/success', function () {
    return view('restaurant/success');
});

Route::get('register-restaurant', function () {
    return view('restaurant/register');
});

Route::post('submitRestaurant','Restaurants@save');
Route::post('approveRestaurant','Restaurants@approve');

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

Route::get('dashboard/gebruiksgegevensadd', function () {
    return view('dashboard/gebruiksgegevensadd');
});

Route::post('dashboard/submitGebruiksgegevens','Gebruiksgegevens@save');
Route::get('dashboard/dashboard1','Gebruiksgegevens@read');
Route::post('dashboard/deleteGebruiksgegevens','Gebruiksgegevens@delete');

Route::get('dashboard/gebruiksgegevens', 'Gebruiksgegevens@find');
Route::post('dashboard/gebruiksgegevens/editGebruiksgegevens','Gebruiksgegevens@update');

Route::get('dashboard/dashboard1', function () {
    return view('dashboard/dashboard1');
});

Route::get('dashboard/gebruiksgegevens', function () {
    return view('dashboard/gebruiksgegevens');
});

Route::get('dashboard/settings', function () {
    return view('dashboard/settings');
});
Route::get('dashboard/products/edit-product', 'Products@find');
Route::post('dashboard/products/update-product','Products@update');
