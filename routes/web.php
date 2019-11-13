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

// Products
Route::resource('products', 'ProductController');

Route::get('/product/{product}/layaway', 'LayawayController@save')
    ->name('layaway.save')
    ->middleware('auth');
    
Route::post('/product/{product}/purchase', '\App\Http\Controllers\Api\ProductApiController@purchase')
    ->name('product.purchase');