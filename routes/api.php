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

// ===========================================================================================
// Routes for  Customer data
// ===========================================================================================
// Route::get('customer', 'Customers\CustomerController@customer');
// Route::get('customer/{id}', 'Customers\CustomerController@customerById');
// Route::post('customer', 'Customers\CustomerController@customerSave');
// Route::put('customer/{id}','Customers\CustomerController@customerUpdate');
// Route::delete('customer/{id}','Customers\CustomerController@customerDelete');
// Route::apiResource('customer', 'Customers\Customer');

// ========================================================================================
// Routes for TiffinvalaData
// ========================================================================================

Route::get('tiffinman', 'Tiffinvala\TiffinvalaController@tiffinman');
Route::get('tiffinman/{id}', 'Tiffinvala\TiffinvalaController@tiffinmanById');
Route::post('tiffinman', 'Tiffinvala\TiffinvalaController@tiffinmanSave');
Route::put('tiffinman/{id}','Tiffinvala\TiffinvalaController@tiffinmanUpdate');
Route::delete('tiffinman/{id}','Tiffinvala\TiffinvalaController@tiffinmanDelete');
Route::apiResource('tiffinman', 'Tiffinvala\Tiffinvala');
