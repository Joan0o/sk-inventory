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

Route::get('Items', 'ItemsController@index');
 
Route::get('Items/{Item}', 'ItemsController@show');
 
Route::post('Items','ItemsController@store');
 
Route::put('Items/{Item}','ItemsController@update');
 
Route::delete('Items/{Item}', 'ItemsController@delete');