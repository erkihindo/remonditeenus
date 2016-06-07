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
    'middleware' => 'auth',
    'as' => '/'
    ]);



Route::auth();


//KLIENT
Route::get('/customerorders', [
    'uses' => 'ServiceOrderController@viewCustomerOrders',
    'as' => 'customerorders',
    'middleware' => 'auth'
    ]);

Route::get('/notes/{id}', [
    'uses' => 'ServiceNoteController@getNotes',
    'middleware' => 'auth'
    ]);



//TÖÖTAJA
Route::get('/deviceparts', [
    'uses' => 'DevicePartsController@index',
    'middleware' => 'employee'
    ]);
Route::get('/logs',[
    'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
    'middleware' => 'employee']);
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

Route::get('/invoice', [
    'uses' => 'InvoiceController@index',
    'middleware' => 'employee'
    ]);
Route::get('/invoices', [
    'uses' => 'InvoiceController@showAll',
    'as' => 'invoices',
    'middleware' => 'employee'
    ]);
Route::get('/editinvoice/{id}', [
    'uses' => 'InvoiceController@openEdit',
    'middleware' => 'employee'
    ]);

Route::post('/serviceorders', [
    'uses' => 'ServiceOrderController@createOrder',
    'as' => 'serviceorder.create',
    'middleware' => 'employee'
    ]);
Route::post('/saveserviceorder', [
    'uses' => 'ServiceOrderController@saveOrder',
    'as' => 'saveserviceorder',
    'middleware' => 'employee'
    ]);
Route::post('/updateserviceorder', [
    'uses' => 'ServiceOrderController@updateOrder',
    'as' => 'updateserviceorder',
    'middleware' => 'employee'
    ]);
Route::get('/allservicerequests', [
    'uses' => 'ServiceRequestController@allRequests',
    'as' => 'allservicerequests', 
    'middleware' => 'employee'
    ]);

Route::get('/servicerequest', [
    'uses' => 'ServiceRequestController@newRequest',
    'as' => 'servicerequest', 
    'middleware' => 'employee'
    ]);

Route::get('/servicerequest/{id}', [
    'uses' => 'ServiceRequestController@editRequest',
    'middleware' => 'employee'
    ]);

Route::get('/serviceorder/{servicerequest}', [
    'uses' => 'ServiceOrderController@index',
    'as' => 'serviceorder', 
    'middleware' => 'employee'
    ]);

Route::get('/allserviceorders', [
    'uses' => 'ServiceOrderController@getAll',
    'as' => 'allserviceorders', 
    'middleware' => 'employee'
    ]);


Route::post('/newinvoice', [
    'uses' => 'InvoiceController@newInvoice',
    'as' => 'gotoinvoice',
    'middleware' => 'employee'
    ]);

Route::post('/createinvoice', [
    'uses' => 'InvoiceController@createInvoice',
    'as' => 'invoice.create',
    'middleware' => 'employee'
    ]);

Route::post('/updateinvoice', [
    'uses' => 'InvoiceController@updateInvoice',
    'as' => 'invoice.update',
    'middleware' => 'employee'
    ]);

//Töötaja actionid
Route::post('/createrequest',[
    'uses' => 'ServiceRequestController@createRequest',
    'as' => 'servicerequest.create',
    'middleware' => 'employee'
    ]);

Route::post('/updaterequesttwo',[
    'uses' => 'ServiceRequestController@updateRequesttwo',
    'as' => 'servicerequest.update',
    'middleware' => 'employee'
    ]);

Route::post('/saverequest',[
    'uses' => 'ServiceRequestController@saveRequest',
    'as' => 'saverequest',
    'middleware' => 'employee'
    ]);

Route::post('/updaterequest',[
    'uses' => 'ServiceRequestController@updateRequest',
    'as' => 'updaterequest',
    'middleware' => 'employee'
    ]);

Route::post('/createdevice', [
    'uses' => 'DeviceController@createDevice',
    'as' => 'createdevice',
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

Route::get('/getinvoicestatustypes', [
    'uses' => 'InvoiceController@getTypes',
    'as' => 'getinvoicestatustypes', 
    'middleware' => 'employee'
    ]);

Route::get('/finddevices', [
    'uses' => 'DeviceController@searchForDevices',
    'as' => 'finddevices', 
    'middleware' => 'employee'
    ]);

Route::post('/createpart', [
    'uses' => 'DevicePartsController@createPart',
    'as' => 'part.create',
    'middleware' => 'employee'
    ]);
Route::get('/getdevicename', [
    'uses' => 'DeviceController@findByID',
    'as' => 'getdevicename', 
    'middleware' => 'employee'
    ]);

Route::get('/getdevicesbyorderid', [
    'uses' => 'DeviceController@findByOrderID',
    'as' => 'getdevicesbyorderid', 
    'middleware' => 'employee'
    ]);

Route::get('/getsostatebyorderid', [
    'uses' => 'ServiceOrderController@findSoStateByID',
    'as' => 'getsostatebyorderid', 
    'middleware' => 'employee'
    ]);

//KLIENDI ACTIONID
Route::post('/commentorder', [
    'uses' => 'ServiceNoteController@createNote',
    'as' => 'comment.create',
    'middleware' => 'auth'
    ]);
