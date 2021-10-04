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

Route::get('/admin', 'Admin\MenuController@index');

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::post('/admin/logout', 'Auth\LoginController@logout');

Route::get('/admin/users/create', 'Admin\UserController@create');
Route::post('/admin/users/store', 'Admin\UserController@store');
Route::get('/admin/users/store', 'Admin\UserController@afterStored')->name('afterUserStored');
//A user can only edit their own account
Route::get('/admin/users/edit', 'Admin\UserController@edit');
Route::patch('/admin/users/update', 'Admin\UserController@update');
Route::get('/admin/users/updatepassword', 'Admin\UserController@passwordEdit');
Route::patch('/admin/users/updatepassword', 'Admin\UserController@passwordUpdate');
Route::delete('admin/users/delete', 'Admin\UserController@destroy');

Route::resource('/admin/logos', 'Admin\LogoController');
Route::resource('/admin/aboutlinks', 'Admin\AboutLinkController');
Route::resource('/admin/tools', 'Admin\ToolController');
Route::resource('/admin/projects', 'Admin\ProjectController');

Route::get('/admin/cv', 'Admin\CVController@edit');
Route::post('/admin/cv', 'Admin\CVController@update');
Route::patch('/admin/cv', 'Admin\CVController@update');
Route::delete('/admin/cv', 'Admin\CVController@destroy');

Route::get('/admin/subject', 'Admin\SubjectController@edit');
Route::post('/admin/subject', 'Admin\SubjectController@update');
Route::patch('/admin/subject', 'Admin\SubjectController@update');