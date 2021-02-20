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

//Post method for whoami form
Route::post('/whoami','WhatsMyNameController@index'); 

//Get Method for view
Route::get('/askme', function () { return view('whoami'); }); 

Route::get('/login', function () { return view('login'); });
Route::post('/dologin','LoginController@index');

//For the second login2
Route::get('/login2', function ()
{
    return view('login2');
});


//Route to add customer
Route::get('/customer', function()
{
   return view('customer'); 
});
Route::post('/addcustomer', 'CustomerController@index');


//Route to add order
Route::get('/neworder', function()
{
    return view('order');
});
Route::post('/addorder', 'OrderController@index');