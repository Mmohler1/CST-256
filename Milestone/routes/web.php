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

Route::get('/account', 'HomeController@account')->name('account');

Route::get('/admin', 'AdminController@index')->name('admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/doSuspend','AdminController@trySuspend');

Route::post('/doAdmin','AdminController@doAdmin');

Route::post('/doPermSuspend','AdminController@doPermSuspend');
