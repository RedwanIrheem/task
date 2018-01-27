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

//Route::get('/', 'HomeController@index');
//Route::get('/home', 'HomeController@index');
//Route::get('task', 'HomeController@getAllTask');
//Route::get('/', 'HomeController@getTask');
//Route::get('add', 'HomeController@getAdd');
//Route::post('add', 'HomeController@postAdd');
//Route::get('edit/{id}', 'HomeController@getEdit');
//Route::post('edit/{id}', 'HomeController@postEdit');

Route::get('/', ['as' => 'task.index', 'uses' =>'HomeController@getTask']);
Route::get('task', ['as' => 'tasks.get', 'uses' =>'HomeController@getAllTask']);

Route::get('task/add', ['as' => 'task.add', 'uses' =>'HomeController@getAdd']);
Route::post('task/add', ['as' => 'task.add', 'uses' =>'HomeController@postAdd']);

Route::get('task/edit/{id}', ['as' => 'task.edit', 'uses' =>'HomeController@getEdit']);
Route::post('task/edit/{id}', ['as' => 'task.edit', 'uses' =>'HomeController@postEdit']);

Route::get('task/delete/{id}', ['as' => 'task.delete', 'uses' =>'HomeController@postDelete']);
