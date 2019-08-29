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

Route::get('/', 'AdminController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::GET('customer','CustomerController@index');

Route::GET('uploadProduct','AdminController@uploadProduct');

Route::post('uploadProductFinal','AdminController@uploadProductFinal');

Route::GET('productDetails','AdminController@productDetails');

Route::GET('addedToCart','AdminController@addedToCart');

Route::resource('checkout','OrderController');

Route::resource('paymentGateway','OrderController');