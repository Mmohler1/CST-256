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


Route::get('/assessment', 'AssessmentController@index')->name('assessment');

Route::post('/doAnimal', 'AssessmentController@saveAnimal');


//Copy and pasted from another assignment to check why this isn't working
//Still doesn't work
Route::get('/login', function () { return view('login'); });
