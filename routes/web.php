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


//Route::get('/uuuu', function () {
//    return view('welcome');
//});
//Route::middleware(["localization"])->group(function (){
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('companies', 'CompaniesController');
    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
    Route::resource('projects', 'ProjectsController');
    Route::resource('users', 'UsersController');
    Route::resource('tasks', 'TasksController');
    Route::resource('roles', 'RolesController');
    Route::resource('comments', 'CommentsController');
//});
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Route::resource('companies', 'CompaniesController');
//Route::get('projects/create/{company_id?}', 'ProjectsController@create');
//Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
//Route::resource('projects', 'ProjectsController');
//Route::resource('users', 'UsersController');
//Route::resource('tasks', 'TasksController');
//Route::resource('roles', 'RolesController');
//Route::resource('comments', 'CommentsController');
