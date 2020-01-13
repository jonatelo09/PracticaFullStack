<?php

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

Route::get('/', 'ProductController@index')->name('home');
Route::get('tienda', 'ProductController@tienda')->name('tienda');
Route::post('/create', 'ProductController@store')->name('addProduct');
Route::post('/product/{id}/edit', 'ProductController@update')->name('editProduct');
Route::post('/product/{id}', 'ProductController@destroy')->name('destroyProduct');
Route::get('listcarts', 'CartController@index')->name('carts');
Route::post('carts', 'CartController@store')->name('addCart');
Route::post('carts/{id}/edit', 'CartController@update')->name('editCart');
Route::post('carts/{id}', 'CartController@destroy')->name('destroyCart');