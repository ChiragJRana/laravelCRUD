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
Route::post('customervalidate', 'Customers\CustomerController@validateEmail');
// Route::post('customer', 'Customers\CustomerController@customerSave');
Route::put('customerupdate','Customers\CustomerController@customerUpdate');
// Route::delete('customer/{id}','Customers\CustomerController@customerDelete');
Route::apiResource('customer', 'Customers\Customer');

// ========================================================================================
// Routes for TiffinvalaData
// ========================================================================================

// Route::get('tiffinman', 'Tiffinvala\TiffinvalaController@tiffinman');
Route::get('tiffinman/{phoneNumber}', 'Tiffinvala\TiffinvalaController@tiffinmanByPhone');
Route::post('tiffinmanlogin', 'Tiffinvala\TiffinvalaController@tiffinmanVerify');
// Route::put('tiffinman/{id}','Tiffinvala\TiffinvalaController@tiffinmanUpdate');
// Route::delete('tiffinman/{id}','Tiffinvala\TiffinvalaController@tiffinmanDelete');
Route::apiResource('tiffinman', 'Tiffinvala\Tiffinvala');

// ========================================================================================
// Routes for Service
// ========================================================================================

// Route::get('services', 'services\ServicesController@services');
// Route::get('services/{service_id}', 'services\ServicesController@servicesById');
// Route::post('services', 'services\ServicesController@servicesSave');
// Route::put('services/{id}','services\ServicesController@servicesUpdate');
// Route::delete('services/{id}','services\ServicesController@servicesDelete');
// Route::apiResource('services', 'services\Services');

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
