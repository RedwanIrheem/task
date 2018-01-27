<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {

    Route::get('task', 'TaskController@getAllTask');
    Route::get('task/{id}', 'TaskController@getTaskById');
    Route::post('task/add', 'TaskController@postAdd');
    Route::post('task/edit/{id}', 'TaskController@postUpdate');
    Route::post('task/delete/{id}', 'TaskController@postDelete');

    Route::group(['middleware' => ['jwt.auth']], function () {
//        Route::get('task', 'TaskController@getAllTask');
//        Route::get('task/{id}', 'TaskController@getTaskById');
//        Route::post('task/add', 'TaskController@postAdd');
//        Route::post('task/edit/{id}', 'TaskController@postUpdate');
//        Route::post('task/delete/{id}', 'TaskController@postDelete');
    });

});