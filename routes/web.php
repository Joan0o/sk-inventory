<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/user/delete/{id}', 'UserController@delete');
Route::post('/user/update/{id}', 'UserController@update');
Route::post('/user/edit/{id}', 'UserController@edit');
Route::get('/home', 'HomeController@index')->name('home');