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

Route::get('/layout', function() {
    return view('layouts/layout');
});

Route::get('/', 'welcomeController@index');

//---Login---//
//Route::get('/login', 'Auth\LoginController@searchUser');

//---Register---//
Route::POST('/registrar','Auth\RegisterController@create');


//---Tarjetas Programables---//
//Route::get('/tarjetas-programables/nuevo', 'TarjetaController@create');
Route::post('/tarjetas-programables/nuevo', 'TarjetaController@store');
Route::get('/tarjetas-programables/lista', 'TarjetaController@list');
Route::patch('/tarjetas-programables/edit/{id}', 'TarjetaController@update');

//---Mapeo de Mesas---//
Route::get('/mapeo-mesas/mapa', 'MesasController@store');

//---Equipo de Electronica---//
Route::get('/equipoElectronica/nuevo', 'EquipoElectronicaController@create');
Route::post('/equipoElectronica/nuevo', 'EquipoElectronicaController@store');
Route::get('/equipoElectronica/lista', 'EquipoElectronicaController@list');
Route::patch('/equipoElectronica/edit', 'EquipoElectronicaController@update');
Route::delete('/equipoElectronica/eliminar/{id}', 'EquipoElectronicaController@destroy');

//---Maquinaria---//
Route::get('/maquinaria/lista', 'MaquinariaController@list');
Route::post('/maquinaria/nuevo', 'MaquinariaController@store');
Route::patch('/maquinaria/edit/', 'MaquinariaController@update');
Route::post('maquinaria/nuevo/herramienta', 'MaquinariaController@nuevaHerramienta');
Route::patch('maquinaria/edit/herramienta', 'MaquinariaController@updateHerramienta');
Route::delete('/maquinaria/eliminar/{id}', 'MaquinariaController@destroy');

//--Ejemplo fotos--//
Route::get('/photo', 'PhotoController@photo');
Route::get('/qr', 'PhotoController@qr');
Route::post('/photo', 'PhotoController@xxj');
Route::get('/photo/new', 'PhotoController@read');

//-----Articulos Personales----
Route::post('/personal/nuevo', 'ArticulosPersonalesController@store');
Route::get('/personal/lista', 'ArticulosPersonalesController@list');
//Route::patch('/personal/edit/{id}', 'ArticulosPersonalesController@update');
//Route::delete('/personal/eliminar/{id}', 'ArticulosPersonalesController@destroy');

//-----Listado Alumnos(Vista Estatica)-----
Route::get('/', function(){
    return view('ListadoAlumnos/Alumnos');
});

//---Mantenimiento ---
Route::get('/Calendario', 'mantenimientoController@show');

Route::get('/create', 'welcomeController@formCreate');
Route::post('/create', 'welcomeController@create');
Route::post('/registro', 'welcomeController@registrar');

Route::get('/profile', 'HomeController@profile');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
