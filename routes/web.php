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
Route::get('/challanpdf/{id}', 'ChallanController@create_pdf')->name('createchallanpdf');
Route::get('/challankeyword','ChallanController@search_keyword')->name('challan_keyword');
Route::get('/challansearch','ChallanController@search_between_invoice')->name('challan_search_btn');
Route::get('/challan/generate/report','ChallanController@generate_report')->name('challan_generate_report');

Route::resource('/tax/invoice', 'TaxInvoiceController');
Route::get('/pdf/{id}', 'TaxInvoiceController@create_pdf')->name('createpdf');
Route::get('/getstatelist', 'TaxInvoiceController@state_list');
Route::get('/invoicekeyword','TaxInvoiceController@search_keyword')->name('invoice_keyword');
Route::get('/invoicesearch','TaxInvoiceController@search_between_invoice')->name('invoice_search_btn');
Route::get('/invoice/generate/report','TaxInvoiceController@generate_report')->name('invoice_generate_report');

Route::resource('/quotation', 'QuotationController');
Route::get('/quotationpdf/{id}', 'QuotationController@create_pdf')->name('createquotationpdf');
Route::get('/quotationkeyword','QuotationController@search_keyword')->name('quotation_keyword');
Route::get('/quotationsearch','QuotationController@search_between_invoice')->name('quotation_search_btn');
Route::get('/quotation/generate/report','QuotationController@generate_report')->name('quotation_generate_report');

Route::resource('/letter/head', 'LetterHeadController');

Route::get('/profile', 'AdminController@profile')->name('ProfileShow');
Route::get('/change/password/show', 'AdminController@change_pass_show')->name('changePassShow');
Route::post('/change/password', 'AdminController@change_pass')->name('ChangePassword');
Route::get('/setting', 'AdminController@settings')->name('SettingShow');
