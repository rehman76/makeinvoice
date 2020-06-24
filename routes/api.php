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

Route::post('category', 'CategoryController@createCategory');
Route::put('category/{id}', 'CategoryController@updateCategory');
Route::get('category','CategoryController@fetchallCategory');
Route::delete('category/{id}', 'CategoryController@deleteCategory');


Route::post('vendor', 'VendorController@createVendor');
Route::get('vendor','VendorController@fetchallVendor');
Route::put('vendor/{id}','VendorController@updateVendor');
Route::delete('vendor/{id}','VendorController@deleteVendor');

Route::post('master_invoice', 'MasterInvoiceController@createmasterInvoice');
Route::post('createinvoice', 'MasterInvoiceController@perpareInvoice');
Route::get('master_invoice', 'MasterInvoiceController@fetchallmasterInvoice');
Route::put('master_invoice/{id}','MasterInvoiceController@updatemasterInvoice');
Route::delete('master_invoice/{id}','MasterInvoiceController@deletemasterInvoice');

Route::post('master_invoice_lines', 'MasterInvoiceLineController@createmasterinvoiceLine');
Route::get('master_invoice_lines', 'MasterInvoiceLineController@fetchallmasterinvoiceLine');
Route::put('master_invoice_lines/{id}','MasterInvoiceLineController@updatemasterinvoiceLine');
Route::delete('master_invoice_lines/{id}','MasterInvoiceLineController@deletemasterinvoiceLine');


Route::post('invoice', 'InvoiceController@createInvoice');
Route::get('invoice', 'InvoiceController@fetchallInvoice');
Route::put('invoice/{id}','InvoiceController@updateInvoice');
Route::delete('invoice/{id}','InvoiceController@deleteInvoice');


Route::post('invoice_line', 'InvoiceLineController@createinvoiceLine');
Route::get('invoice_line', 'InvoiceLineController@fetchallinvoiceLine');
Route::put('invoice_line/{id}','InvoiceLineController@updateinvoiceLine');
Route::delete('invoice_line/{id}','InvoiceLineController@deleteinvoiceLine');



