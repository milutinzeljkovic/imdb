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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::group(['middleware' => ['jwt.verify'],'prefix' => 'movies'], function () {
    Route::get('', 'Api\MovieController@index');
    Route::get('{movie}', 'Api\MovieController@show')->middleware('can:view,movie');
    Route::post('add', 'Api\MovieController@store');
    Route::put('{movie}','Api\MovieController@update')->middleware('can:update,movie');
    Route::delete('{movie}', 'Api\MovieController@destroy')->middleware('can:delete,movie');

});

