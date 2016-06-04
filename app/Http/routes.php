<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'HomeController@index',
    'middleware' => 'auth'
    ]);

Route::auth();


//KLIENT
Route::get('/orders', [
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);

Route::get('/notes', [
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);

Route::get('/bills', [
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);


//TÖÖTAJA
Route::get('/deviceparts', [
    'uses' => 'DevicePartsController@index',
    'middleware' => 'employee'
    ]);
Route::get('/devices', [
    'uses' => 'DeviceController@alldevices',
    'middleware' => 'employee'
    ]);
Route::get('/adddevice', [
    'uses' => 'DeviceController@adddevice',
    'middleware' => 'employee'
    ]);
Route::get('/invoices', [
    'uses' => 'InvoiceController@index',
    'middleware' => 'employee'
    ]);
Route::get('/serviceorders', [
    'uses' => '______@index',
    'middleware' => 'employee'
    ]);

Route::get('/servicerequest', [
    'uses' => 'ServiceRequestController@index',
    'as' => 'servicerequest', 
    'middleware' => 'employee'
    ]);

Route::get('/serviceorder/{servicerequest}', [
    'uses' => 'ServiceOrderController@index',
    'as' => 'serviceorder', 
    'middleware' => 'employee'
    ]);

//Töötaja actionid
Route::post('/createrequest',[
    'uses' => 'ServiceRequestController@createRequest',
    'as' => 'servicerequest.create',
    'middleware' => 'employee'
        
        ]);

Route::get('/getallcustomers', [
    'uses' => 'CustomerController@getAll',
    'as' => 'getAllCustomers', 
    'middleware' => 'employee'
    ]);



