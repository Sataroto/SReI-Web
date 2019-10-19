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

<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
});

Route::get('/layout', function() {
    return view('layouts/layout');
});
=======
Route::get('/', 'welcomeController@index');
>>>>>>> 5cbe66da58cd8aead46454d17b2f656938d8781b
