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

	Route::get('/posts', 'PostsController@index')->middleware('can:browse-only')->name('posts.index');
	Route::group(['prefix' => 'posts', 'middleware' => ['can:control-all']], function()
	{
		Route::get('/create', 'PostsController@craete')->name('posts.create');
		Route::get('{id}/edit', 'PostsController@edit')->name('posts.edit');
		Route::patch('{id}/edit', 'PostsController@update')->name('posts.update');
		Route::get('/{id}/destroy', 'PostsController@destroy')->name('posts.destroy');
	});

	Route::get('/users', 'HomeController@users')->name('users');
	Route::view('/', 'welcome');
});

Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin')->middleware('can:control-all');
	Route::get('/ajax/changeRoles/', 'Admin\AdminController@changeRoles')->middleware('can:change-roles');
});


