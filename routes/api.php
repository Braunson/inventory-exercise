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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Product Comments
Route::namespace('Api')->prefix('products/{product}')->group(function () {
    Route::get('comments', 'ProductApiController@getComments');
    Route::post('comment', 'ProductApiController@saveComment');
});