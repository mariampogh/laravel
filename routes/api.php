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


Route::group(['middleware' => ['web']], function () {
    Route::get('login', 'API\PassportController@showLoginForm')->name('api.loginForm');
    Route::get('register', 'API\PassportController@showRegisterForm')->name('api.registerForm');
	Route::post('login', 'API\PassportController@login')->name('api.login');
	Route::post('register', 'API\PassportController@register')->name('api.register');
});


Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'API\PassportController@getDetails');
});