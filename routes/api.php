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

Route::namespace('Api')->name('api.')->group(function(){
	Route::prefix('/products')->group(function(){
		
		Route::get('/', 'ProductController@index')->name('index_products');
		Route::get('/{id}', 'ProductController@show')->name('single_products');
		Route::post('/', 'ProductController@store')->name('store_products');
		Route::put('/{id}', 'ProductController@update')->name('update_products');
		Route::delete('/{id}', 'ProductController@delete')->name('delete_products');

	});

	Route::prefix('/temperatures')->group(function(){
		
		Route::get('/', 'TemperatureController@index')->name('index_temperatures');
		Route::get('/{id}', 'TemperatureController@show')->name('single_temperatures');
		Route::post('/', 'TemperatureController@store')->name('store_temperatures');
		Route::put('/{id}', 'TemperatureController@update')->name('update_temperatures');
		Route::delete('/{id}', 'TemperatureController@delete')->name('delete_temperatures');

	});
	Route::prefix('/luminosities')->group(function(){
		
		Route::get('/', 'LuminosityController@index')->name('index_luminosities');
		Route::get('/{id}', 'LuminosityController@show')->name('single_luminosities');
		Route::post('/', 'LuminosityController@store')->name('store_luminosities');
		Route::put('/{id}', 'LuminosityController@update')->name('update_luminosities');
		Route::delete('/{id}', 'LuminosityController@delete')->name('delete_luminosities');

	});
	
});