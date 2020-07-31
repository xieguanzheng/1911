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
Route::get('/user/info','TestController@userInfo');
Route::post('/user/login','TestController@login');
Route::any('/test/decrypt1','TestController@decrypt1');
Route::any('/test/desc','TestController@desc');
Route::get('/test/sign1','TestController@sign1');
Route::get('/test4','TestController@test4');
Route::any('/admin/regadd','Admin\LoginController@regadd');
Route::post("/admin/regdo","Admin\LoginController@regdo");//注册