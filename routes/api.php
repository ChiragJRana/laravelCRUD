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

Route::get('customer', 'Customer\CustomerController@customer');
Route::get('customer/{id}', 'Customer\CustomerController@customerById');
Route::post('customer', 'Customer\CustomerController@customerSave');
Route::put('customer/{id}','Customer\CustomeryController@customerUpdate');
Route::delete('customer/{id}','Customer\CustomerController@customerDelete');

// Route::apiResource('customer', 'Customer/Customer');