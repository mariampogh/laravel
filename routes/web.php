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
//-----------User-------//
Route::get('/home', 'User\UserController@index')->name('home');

Route::group(['prefix' => '/user','namespace' => "User"],function(){

	Route::get('/cvQuestons/{id}', 'UserController@cv')->name('blankCv');
	Route::post('/createCv', 'UserController@createCv')->name('createCv');
	Route::get('/changeInfoPage', 'UserController@changeInfoPage')->name('changeInfoPage');
	Route::post('/changePwd', 'UserController@changePwd')->name('user.changePwd');
	Route::post('/editInfo', 'UserController@editInfo')->name('editInfo');
	Route::get('/userCv', 'UserController@userCv')->name('user.userCV');
	Route::post('/userCv/edit', 'UserController@editCv')->name('user.editCv');
	Route::get('/exportPdf', 'UserController@exportPdf')->name('user.exportPdf');

});

//-----------Admin-------//
Route::get('/chart','Admin\AdminController@chart')->name('admin.chart');
Route::get('/admin/users/changePwdAction/{id}', 'Admin\UserController@changePwdAction')
		->name('admin.changePwd');
Route::post('/admin/users/changePwd', 'admin\UserController@changePwd')->name('changePwd');
Route::post('/admin/userCv/edit', 'Admin\UserController@editCv')->name('admin.editCv');
Route::get('/admin/exportPdf/{id}', 'Admin\UserController@exportPdf')->name('admin.exportPdf');
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

