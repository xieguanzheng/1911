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
Route::get('/wx/token','TestController@getWToken');
Route::get('/wx/token2','TestController@getWToken2');
Route::get('/wx/token3','TestController@getWToken3');
Route::get('/test1','TestController@test1');
Route::post('/user/login','TestController@login');
Route::any('/user/reg','User\IndexController@reg');
Route::post('/user/login','User\IndexController@login');