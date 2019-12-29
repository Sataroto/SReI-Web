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


Route::get('/layout', function() {
    return view('layouts/layout');
});

Route::get('/', 'welcomeController@index');

Route::get('/registroMaquina', 'MaquinariaController@create');
Route::post('/registroMaquina', 'MaquinariaController@store');
Route::get('/listaMaquina', 'MaquinariaController@list');

Route::get('/create', 'welcomeController@formCreate');
Route::post('/create', 'welcomeController@create');

Route::post('/registro', 'welcomeController@registrar');
