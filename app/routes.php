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
	if(Auth::check()){ return Redirect::to('/tasks'); }
	else { return View::make('index'); }
});

Route::post('/login', 'AuthController@post_login')->before('crsf');

Route::get('/login', function()
{
	return Redirect::to('/');
});

Route::get('/logout', array('before' => 'auth', 'uses' => 'AuthController@get_logout'));

Route::get('/forgotten_password', function()
{
	return View::make('request_forgotten_password');
});

Route::post('/post_forgotten_password', array('before' => 'crsf', 'uses' => 'AuthController@post_forgotten_password'));

Route::get('/new_password/{code}', function($code)
{
	return View::make('new_password')->with('code', $code);
});

Route::get('/new_password', function()
{
	return Redirect::to('/')->withErrors('Wrong request.');
});

Route::post('/post_new_password', array('before' => 'crsf', 'uses' => 'AuthController@post_new_password'));

Route::get('/register', function()
{
	return View::make('register');
});

Route::post('/post_register', array('before' => 'crsf', 'uses' => 'AuthController@post_register'));

Route::get('/confirm/{username}/{code}', 'AuthController@get_confirm');

Route::get('/tasks', array('before' => 'auth', 'uses' => 'TasksController@get_tasks'));

Route::post('/add_new', array('before' => 'auth', 'uses' => 'TasksController@post_add_new'));

Route::post('/remove_task', array('before' => 'auth', 'uses' => 'TasksController@post_remove_task'));

Route::post('/check_task', array('before' => 'auth', 'uses' => 'TasksController@post_check_task'));

Route::post('/uncheck_task', array('before' => 'auth', 'uses' => 'TasksController@post_uncheck_task'));
