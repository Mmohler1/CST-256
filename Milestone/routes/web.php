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

Route::get('/suspended', 'AdminController@suspended')->name('admin');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/doSuspend','AdminController@trySuspend');

Route::post('/doAdmin','AdminController@doAdmin');

Route::post('/doPermSuspend','AdminController@doPermSuspend');

Route::post('/doUser','AdminController@doUser');


//Routes for portfolio

Route::get('portfolio', 'PortfolioController@index');
Route::get('addPortfolio', 'PortfolioController@addPortfolio'); 

Route::post('doAdd','PortfolioController@createPortfolio');



Route::post('updateAPortfolio','PortfolioController@updatePortfolioRedirect'); //for getting to update page

Route::get('updatePortfolio', 'PortfolioController@updatePortfolio');

Route::post('doUpdate','PortfolioController@changePortfolio');

Route::post('doDelete','PortfolioController@deletePortfolio');


//Routes for job 
Route::get('job', 'JobController@index');

Route::get('allJobs', 'JobController@allJobs');

Route::get('addJob', 'JobController@addJob');



Route::get('searchJob', 'JobController@searchJob');


Route::get('uniqueJob', 'JobController@specificJob'); 

//Milestone 5
Route::get('doSearchJob','JobController@lookJob');


Route::post('doAddJob','JobController@createJob');


Route::post('updateAJob','JobController@updateJobRedirect'); //for getting to update page

Route::get('updateJob', 'JobController@updateJob');

Route::post('doUpdateJob','JobController@changeJob');

Route::post('doDeleteJob','JobController@deleteJob');




//Routes for groups

Route::get('/group', 'GroupController@index');

Route::get('/addGroup', 'GroupController@createGroup'); 

Route::get('/uniqueGroup', 'GroupController@specificGroup'); 

Route::get('/updateGroup', 'GroupController@changeGroup');


//Basically gets, but use them as posts
Route::get('/doLeaveGroupe', 'GroupController@leaveGroupe');
Route::get('/doJoinGroupe', 'GroupController@addGroupe');


Route::post('/doAddGroup','GroupController@addGroup');

Route::post('/doDeleteGroup','GroupController@deleteGroup');

Route::post('/updateAGroup','GroupController@changeGroupRedirect'); //for getting to update page

Route::post('/doUpdateGroup','GroupController@updateGroup');
