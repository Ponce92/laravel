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

Route::get('/','Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login')->name('login');
Route::get('logout','Auth\LoginController@logout')->name('logout');

Route::post('/registro','RegistroController@postRegistro');
Route::get('/registro','RegistroController@getRegistro');
Route::get('/dashboard','adminController@getAdmin')->name('dashboard');


Route::get('/perfil/datosPersonales','PerfilController@verDatosPersonales')->name('gestionDatosPersonales');
Route::post('/perfil/datosPersonales','PerfilController@editarDatosPersonales')->name('editarDatosPersonales');

Route::get('/perfil/proyectosRealizados','PerfilController@verProyectosRealizados')->name('gestionProyectosRealizados');
Route::get('/perfil/publicaciones','PerfilController@verPublicaciones')->name('gestionPublicaciones');


