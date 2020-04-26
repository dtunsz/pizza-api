<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('orders/deliver', 'api\OrderController@deliver');
Route::post('orders/deliver/{orderId}', 'api\OrderController@delivered')->name('orders.delivered');
Route::get('orders/confirm', 'api\OrderController@confirm');
Route::post('orders/confirm/{orderId}', 'api\OrderController@confirmed')->name('orders.confirmed');
Route::apiResource('orders', 'api\OrderController');
Route::apiResource('products', 'api\ProductController');

