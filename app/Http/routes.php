<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/login', array('uses' => 'HomeController@showLogin'));
Route::post('/login', array('uses' => 'HomeController@doLogin'));
Route::get('/', function () {
    return view('dashboard',['email' => 'James']);
});

Route::get('/documentation', function () {
    return view('document.index')->with('email',Auth::user()->email);
});

Route::get('/charts', function () {
    return view('errors.underConstruction')->with('email',Auth::user()->email);
});
Route::get('/forms', function () {
    return view('errors.underConstruction');
});
Route::resource('location','LocationController');
Route::resource('media','MediaController');
Route::resource('location_media','LocationMediaController');
Route::auth();

Route::get('/home', 'HomeController@index');

// route to show the login form

// route to process the form
Route::get('/logout', array('uses' => 'HomeController@doLogout'));

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
