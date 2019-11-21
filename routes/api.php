<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Product Comments
Route::namespace('Api')->prefix('products/{product}')->group(function () {
    Route::get('comments', 'ProductCommentsApiController@retrieve');
    Route::post('comment', 'ProductCommentsApiController@save');
});