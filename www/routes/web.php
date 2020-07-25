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
Route::get('/info', function () {
    phpinfo();
});

Route::get('/redis/hash1','TestController@hash1');
Route::get('/redis/hash2','TestController@hash2');
Route::get('/cont','TestController@cont');
Route::get('/user/sign','User\IndexController@sign');


Route::get('/wx/token','TestController@getWToken');
Route::get('/wx/token2','TestController@getWToken2');
Route::get('/wx/token3','TestController@getWToken3');
Route::get('/test1','TestController@test1');
Route::post('/user/login','TestController@login');




Route::any('/user/reg','User\IndexController@reg');
Route::any('/user/login','User\IndexController@login')->middleware('verify.token');
Route::get('/user/center','User\IndexController@center')->middleware('count');

//签名
Route::any('/test/sign1','TestController@sign1');

//对称加密
Route::get('/encrtypt1','TestController@encrtypt1');
//非对称加密
Route::get("/rsa","TestController@rsa");
Route::get('/rsa/resaeEncypt1','TestController@resaeEncypt1');