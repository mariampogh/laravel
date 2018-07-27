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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//-----------Admin-------//
Route::get('/admin','Admin\AdminController@index');
Route::get('/admin/passport',function(){
	return view('admin.passport');
})->middleware('admin');

// --------- Posts ------//

Route::resource('posts', 'PostController');

//------- Users ----- //
Route::resource('/admin/users', 'admin\UserController');
