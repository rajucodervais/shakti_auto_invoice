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

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/challan', 'ChallanController');
Route::resource('/tax/invoice', 'TaxInvoiceController');
Route::resource('/quotation', 'QuotationController');
Route::get('/profile', 'AdminController@profile')->name('profile');
Route::get('/change/password', 'AdminController@change_pass')->name('changePass');
Route::get('/setting', 'AdminController@settings')->name('setting');
