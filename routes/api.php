<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('test/', function () {
    echo "API Rodando";
});

Route::group(['middleware' => ['apiJwt'], 'prefix' => 'auth',], function ($router) {

    //User
    Route::post('user/{id}', 'V1\\UserController@update');
    Route::get('user/{id}', 'V1\\UserController@show');
});


Route::group(['prefix' => ''], function ($router) {
    Route::post('user', 'V1\\UserController@store');
    Route::post('login', 'V1\\AuthController@login');
});
