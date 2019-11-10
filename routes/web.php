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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/product/{product}', 'ProductController@show')->name('product.show');

// Placeholder, in the future this would instead take you to a CC form or cart etc.
Route::post('/product/{product}/purchase', 'ProductController@purchase')->name('product.purchase');

Route::get('/product/{product}/layaway', 'LayawayController@show')->name('layaway.show');