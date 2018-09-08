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
Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], 
function()
{
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('/posts', 'PostsController');
	Route::get('/posts/{id}/destroy', 'PostsController@destroy')->name('posts.destroy');
	Route::get('/users', 'HomeController@users')->name('users');
	Route::view('/', 'welcome');
});

Route::group(['prefix' => 'admin','middleware' => ['can:control-all']], function(){
	Route::view('/', 'admins.index')->name('admin');

	Route::post('/role', function(){
		dd(request()->input('role'));
	})->name('admin.roles');
	
});


