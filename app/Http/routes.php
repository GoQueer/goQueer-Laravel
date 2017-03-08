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
Route::get('/', function () {
    return view('home',['email' => 'James']);
});

Route::get('/login', array('uses' => 'HomeController@showLogin'));
Route::post('/login', array('uses' => 'HomeController@doLogin'));
Route::get('/logout', array('uses' => 'HomeController@doLogout'));


Route::get('/documentation', function () {
    return view('document.index')->with('email',Auth::user()->email);
});

Route::get('/features', function () {
    return view('feature.index')->with('email',Auth::user()->email);
});

Route::get('/register', function () {
    return view('auth.register');
});
Route::resource('order', 'OrderController');
Route::resource('location','LocationController');
Route::resource('draft','DraftController');
Route::resource('media','MediaController');
Route::resource('gallery','GalleryController');
Route::resource('message','MessageController');
Route::resource('gallery_media','GalleryMediaController');
Route::resource('test','TestController');
Route::resource('final','FinalController');
Route::resource('map','MapController');
Route::auth();

Route::get('/home', 'HomeController@index');



Route::get('/client/getLocations', array('uses' => 'ClientController@getLocations'));