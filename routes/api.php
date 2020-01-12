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

    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post("new", "UserController@new");
});

Route::group([

    "prefix" => "users"

], function($router) {

    Route::delete('/{id}', 'UserController@delete');
    Route::get('/{id}', 'UserController@get');
    Route::patch('/{id}', 'UserController@update');

    Route::patch('/points/{id}', 'PointController@addPoint');

});

