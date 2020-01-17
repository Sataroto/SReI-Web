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

//---Tarjetas Programables---//
//Route::get('/tarjetas-programables/nuevo', 'TarjetaController@create');
Route::post('/tarjetas-programables/nuevo', 'TarjetaController@store');
Route::get('/tarjetas-programables/lista', 'TarjetaController@list');
Route::patch('/tarjetas-programables/edit/{id}', 'TarjetaController@update');


//---Equipo de Electronica---//
Route::get('/equipoElectronica/nuevo', 'EquipoElectronicaController@create');
Route::post('/equipoElectronica/nuevo', 'EquipoElectronicaController@store');
Route::get('/equipoElectronica/lista', 'EquipoElectronicaController@list');
Route::patch('/equipoElectronica/edit/{id}', 'EquipoElectronicaController@update');

//---Maquinaria---//

//Route::get('/maquinaria/nuevo', 'MaquinariaController@create');
Route::post('/maquinaria/nuevo', 'MaquinariaController@store');
Route::get('/maquinaria/lista', 'MaquinariaController@list');
Route::patch('/maquinaria/edit/{id}', 'MaquinariaController@update');
Route::delete('/maquinaria/eliminar/{id}', 'MaquinariaController@destroy');

Route::get('/create', 'welcomeController@formCreate');
Route::post('/create', 'welcomeController@create');

Route::post('/registro', 'welcomeController@registrar');
