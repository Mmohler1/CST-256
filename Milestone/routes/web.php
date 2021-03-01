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

Route::get('eportfolio/portfolio', 'PortfolioController@index');
Route::get('eportfolio/addPortfolio', 'PortfolioController@addPortfolio'); 

Route::post('eportfolio/doAdd','PortfolioController@createPortfolio');



Route::post('eportfolio/updateAPortfolio','PortfolioController@updatePortfolioRedirect'); //for getting to update page

Route::get('eportfolio/updatePortfolio', 'PortfolioController@updatePortfolio');

Route::post('eportfolio/doUpdate','PortfolioController@changePortfolio');

Route::post('eportfolio/doDelete','PortfolioController@deletePortfolio');


//Routes for job 
Route::get('posting/job', 'JobController@index');

Route::get('posting/allJobs', 'JobController@allJobs');

Route::get('posting/addJob', 'JobController@addJob');

Route::post('posting/doAddJob','JobController@createJob');



Route::post('posting/updateAJob','JobController@updateJobRedirect'); //for getting to update page

Route::get('posting/updateJob', 'JobController@updateJob');

Route::post('posting/doUpdateJob','JobController@changeJob');

Route::post('posting/doDeleteJob','JobController@deleteJob');




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
