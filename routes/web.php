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

Route::get('/usuario','UsuarioController@verUsuario')->name('verUsuario');
Route::post('/usuario/editar','UsuarioController@actualizarUsuario')->name('actualizarUsuario');

Route::get('/perfil/proyectosRealizados','ProyectosRealizadosController@verProyectos')->name('gestionProyectosRealizados');
Route::post('/perfil/crear/proyectosRealizados','ProyectosRealizadosController@agregarProyecto')->name('agregarProyectosRealizado');
Route::post('/perfil/editar/proyectosRealizados','ProyectosRealizadosController@editarProyecto')->name('editarProyectosRealizado');
Route::post('/perfil/eliminar/proyectosRealizados','ProyectosRealizadosController@eliminarProyecto')->name('eliminarProyectosRealizado');

Route::get('/perfil/proyectosRealizados/ajax','ProyectosRealizadosController@getProyectosAjax')->name('getProyectosRealizadosAjax');


Route::get('/perfil/ver/publicaciones','PublicacionesController@verPublicaciones')->name('verPublicaciones');
Route::post('/perfil/crear/publicacion','PublicacionesController@crearPublicacion')->name('agregarPublicacion');
Route::post('/perfil/actualizar/publicacion','PublicacionesController@actualizarPublicacion')->name('actualizarPublicacion');
Route::post('/perfil/eliminar/publicacion','PublicacionesController@eliminarPublicacion')->name('eliminarPublicacion');

Route::get('/perfil/publicaciones/ajax','PublicacionesController@getPublicacionAjax')->name('getPublicacionAjax');

