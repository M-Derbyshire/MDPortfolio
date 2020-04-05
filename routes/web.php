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

Route::get('/', 'PublicController@index');
Route::get('/projects', 'PublicController@projectList');
Route::get('/projects/{id}', 'PublicController@project');

Route::get('/admin', 'MenuController@index');

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::post('/admin/logout', 'Auth\LoginController@logout');

Route::get('/admin/users/create', 'UserController@create');
Route::post('/admin/users/store', 'UserController@store');
Route::get('/admin/users/store', 'UserController@afterStored')->name('afterUserStored');
//A user can only edit their own account
Route::get('/admin/users/edit', 'UserController@edit');
Route::patch('/admin/users/update', 'UserController@update');
Route::get('/admin/users/updatepassword', 'UserController@passwordEdit');
Route::patch('/admin/users/updatepassword', 'UserController@passwordUpdate');
Route::delete('admin/users/delete', 'UserController@destroy');

Route::resource('/admin/logos', 'LogoController');
Route::resource('/admin/aboutlinks', 'AboutLinkController');
Route::resource('/admin/tools', 'ToolController');
Route::resource('/admin/projects', 'ProjectController');

Route::get('/admin/cv', 'CVController@edit');
Route::post('/admin/cv', 'CVController@update');
Route::patch('/admin/cv', 'CVController@update');
Route::delete('/admin/cv', 'CVController@destroy');

Route::get('/admin/subject', 'SubjectController@edit');