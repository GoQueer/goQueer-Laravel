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
    return view('dashboard');
});

Route::get('/documentation', function () {
    return view('document.index');
});
Route::resource('location','LocationController');
Route::resource('media','MediaController');
Route::resource('location_media','LocationMediaController');