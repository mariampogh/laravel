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
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'User\UserController@index')->name('home');
Route::get('/user/cvQuestons/{id}', 'User\UserController@cv')->name('blankCv');
Route::post('/user/createCv', 'User\UserController@createCv')->name('createCv');
Route::get('/user/changeInfoPage', 'User\UserController@changeInfoPage')->name('changeInfoPage');
Route::post('/user/changePwd', 'User\UserController@changePwd')->name('changePwd');
Route::post('/user/editInfo', 'User\UserController@editInfo')->name('editInfo');
Route::get('/user/userCv', 'User\UserController@userCv')->name('user.userCV');
Route::post('/user/userCv/edit', 'User\UserController@editCv')->name('user.editCv');
//-----------Admin-------//
Route::get('/admin','Admin\AdminController@index');
Route::get('/chart','Admin\AdminController@chart');
Route::get('/admin/passport',function(){
	return view('admin.passport');
})->middleware('admin');


			//------- 1.Users ----- //
Route::get('/admin/users/changePwdAction/{id}', 'Admin\UserController@changePwdAction');
Route::post('/admin/users/changePwd', 'admin\UserController@changePwd');
Route::get('/admin/userCv/{id}', 'Admin\UserController@userCv')->name('admin.userCV');
Route::post('/admin/userCv/edit', 'Admin\UserController@editCv')->name('admin.editCv');
Route::resource('/admin/users', 'admin\UserController');

//------- Socials ----- //

Route::get(
    'socialite/{provider}',
    [ 
        'as' => 'socialite.auth',
        function ( $provider ) {
            return Socialite::driver( $provider )->redirect();
        }
    ]
);

Route::get('socialite/{provider}/callback','Auth\LoginController@signInSocial');

