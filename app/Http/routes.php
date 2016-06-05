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
Route::get('/customerorders', [
    'uses' => 'ServiceOrderController@viewCustomerOrders',
    'as' => 'customerorders',
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
    'as' => 'devices',
    'middleware' => 'employee'
    ]);
Route::get('/adddevice', [
    'uses' => 'DeviceController@adddevice',
    'as' => 'adddevice',
    'middleware' => 'employee'
    ]);
Route::get('/addpart', [
    'uses' => 'DevicePartsController@addPart',
    'as' => 'addpart',
    'middleware' => 'employee'
    ]);

Route::get('/invoices', [
    'uses' => 'InvoiceController@index',
    'middleware' => 'employee'
    ]);
Route::get('/serviceorders', [
    'uses' => 'ServiceOrderController@index',
    'as' => 'serviceorder.create',
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

Route::post('/createdevice', [
    'uses' => 'DeviceController@createDevice',
    'as' => 'device.create',
    'middleware' => 'employee'
    ]);

Route::get('/getallcustomers', [
    'uses' => 'CustomerController@getAll',
    'as' => 'getAllCustomers', 
    'middleware' => 'employee'
    ]);

Route::get('/getsostatustypes', [
    'uses' => 'SoStatusController@getAll',
    'as' => 'getsostatustypes', 
    'middleware' => 'employee'
    ]);

Route::get('/getservicetypes', [
    'uses' => 'ServiceController@getAll',
    'as' => 'getservicetypes', 
    'middleware' => 'employee'
    ]);

Route::get('/getdevicetypes', [
    'uses' => 'DeviceController@getTypes',
    'as' => 'getdevicetypes', 
    'middleware' => 'employee'
    ]);
