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
Route::post('master_invoice', 'MasterInvoiceController@createmasterInvoice');
Route::get('master','MasterInvoiceController@getInvoice');
Route::get('category','CategoryController@fetchallCategory');
Route::get('createinvoice', 'MasterInvoiceController@prepareInvoice');
Route::get('view','MasterInvoiceController@createInvoice')->name('invoice');
Route::get('makeinvoice/{id}','MasterInvoiceController@fetchStatement')->name('makeinvoice');
/*Route::get('view', function()
{
    return view('invoice');
})->name('invoice');*/
