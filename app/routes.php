<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('guest.index');
});

Route::group(array('before' => 'auth'), function () {
	Route::get('dashboard', 'HomeController@dashboard');
	Route::group(array('prefix' => 'admin', 'before' => 'admin'), function()
	{
		Route::resource('authors', 'AuthorsController');
	});
});


Route::get('dashboard', array('before' => 'auth', 'uses' => 'HomeController@dashboard'));
Route::get('login', array('guest.login', 'uses'=>'GuestController@login'));
Route::get('logout', 'HomeController@logout');
Route::post('authenticate', 'HomeController@authenticate');


