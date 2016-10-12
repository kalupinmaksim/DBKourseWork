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

Route::get('/', 'HomeController@start');

//Route::post('/', 'HomeController@getMark');
Route::post('/', 'HomeController@get');

Route::get('/admin', 'HomeController@start_admin_panel');
Route::post('/AddData', 'HomeController@addDB_admin');

Route::post('/UpdateData', 'HomeController@updateDB');



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/logout', function (){
    Auth::logout();
    return redirect('home');
});

Route::post('/arend', 'HomeController@rent');

Route::get('/profile', 'HomeController@ProfileContent');
Route::post('/AddComment', 'HomeController@AddComment');