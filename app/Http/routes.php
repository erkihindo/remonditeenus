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
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);
Route::get('/devices', [
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);
Route::get('/invoices', [
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);
Route::get('/serviceorders', [
    'uses' => '______@index',
    'middleware' => 'auth'
    ]);







