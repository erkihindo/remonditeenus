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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//KLIENT
Route::get('/orders', '____@index');

Route::get('/notes', '____@index');

Route::get('/bills', '____@index');


//TÖÖTAJA
Route::get('/deviceparts', '____@index');
Route::get('/devices', '____@index');
Route::get('/invoices', '____@index');
Route::get('/serviceorders', '____@index');







