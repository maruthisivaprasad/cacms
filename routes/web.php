<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('director/excel', 'DirectorController@excel');
Route::get('fee/excel', 'FeeController@excel');
Route::get('document/excel', 'DocumentController@excel');
Route::get('payment/excel', 'PaymentController@excel');
Route::get('task/excel', 'TaskController@excel');
Route::get('client/excel', 'ClientController@excel');
/*Route::get('contact', 'ContactController@index');
Route::get('contact/create', 'ContactController@create');
Route::post('contact/store', 'ContactController@store');
Route::get('contact/update', 'ContactController@update');
Route::get('contact/view', 'ContactController@view');*/
Route::resource('contact','ContactController');
Route::resource('client','ClientController');
Route::resource('director','DirectorController');
Route::resource('fee','FeeController');
Route::resource('document','DocumentController');
Route::resource('payment','PaymentController');
Route::resource('task','TaskController');
