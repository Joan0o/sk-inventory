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

Route::get('/items', 'ItemController@index')->name('items');
Route::post('/item/new', 'ItemController@store');
Route::post('/item/edit/{id}', 'ItemController@edit');
Route::post('/item/update/{id}', 'ItemController@update');
Route::post('/item/delete/{id}', 'ItemController@delete');

Route::get('categories', 'CategoryController@index')->name('categories');
Route::post('/category/new', 'CategoryController@store')->name('category.new');
Route::post('/category/edit/{id}', 'CategoryController@edit');
Route::post('/category/update/{id}', 'CategoryController@update');
Route::post('/category/delete/{id}', 'CategoryController@delete');

Route::get('/subcategories', 'SubcategoryController@index')->name('subcategories');;
Route::post('/subcategory/new', 'SubcategoryController@store')->name('subcategory.new');
Route::post('/subcategory/edit/{id}', 'SubcategoryController@edit');
Route::post('/subcategory/update/{id}', 'SubcategoryController@update');
Route::post('/subcategory/delete/{id}', 'SubcategoryController@delete');

Route::get('/home', 'HomeController@index')->name('home');