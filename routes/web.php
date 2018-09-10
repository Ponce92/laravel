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
Route::get('/home','HomeController@index')->name('home');

Route::get('/','Auth\LoginController@showLoginForm')->name('log');
Route::get('login','Auth\LoginController@showLoginForm')->name('log');
Route::post('login','Auth\LoginController@login')->name('login');
Route::get('logout','Auth\LoginController@logout')->name('logout');

Route::get('password/email','Auth\ForgotPasswordController@showLinkRequestForm')->name('getResetForm');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm');
Route::post('password/reset','Auth\ResetPasswordController@reset');



Route::post('/registro','RegistroController@postRegistro');
Route::get('/registro','RegistroController@getRegistro');
Route::get('/dashboard','adminController@getAdmin')->name('dashboard');


Route::get('/perfil/datosPersonales','PerfilController@verDatosPersonales')->name('gestionDatosPersonales');
Route::post('/perfil/datosPersonales','PerfilController@editarDatosPersonales')->name('editarDatosPersonales');

Route::get('/usuario','UsuarioController@verUsuario')->name('verUsuario');
Route::post('/usuario/editar','UsuarioController@actualizarUsuario')->name('actualizarUsuario');


/*======================================================================================================
 *=====================================      Proyectos realizados ======================================
 * ======================================================================================================
 */

Route::get('/perfil/proyectosRealizados','ProyectosRealizadosController@verProyectos')->name('gestionProyectosRealizados');
Route::post('/perfil/crear/proyectosRealizados','ProyectosRealizadosController@agregarProyecto')->name('agregarProyectosRealizado');
Route::post('/perfil/editar/proyectosRealizados','ProyectosRealizadosController@editarProyecto')->name('editarProyectosRealizado');
Route::post('/perfil/eliminar/proyectosRealizados','ProyectosRealizadosController@eliminarProyecto')->name('eliminarProyectosRealizado');

Route::get('/perfil/proyectosRealizados/ajax','ProyectosRealizadosController@getProyectosAjax')->name('getProyectosRealizadosAjax');


/*======================================================================================================
 *=====================================      Publicaciones realizados ==================================
 * =====================================================================================================
 */

Route::get('/perfil/ver/publicaciones','PublicacionesController@verPublicaciones')->name('verPublicaciones');
Route::post('/perfil/crear/publicacion','PublicacionesController@crearPublicacion')->name('agregarPublicacion');
Route::post('/perfil/actualizar/publicacion','PublicacionesController@actualizarPublicacion')->name('actualizarPublicacion');
Route::post('/perfil/eliminar/publicacion','PublicacionesController@eliminarPublicacion')->name('eliminarPublicacion');

Route::get('/perfil/publicaciones/ajax','PublicacionesController@getPublicacionAjax')->name('getPublicacionAjax');

/*======================================================================================================
 *==============================  Busqueda de perfiles de investigadores ===============================
 * =====================================================================================================
 */
Route::get('/investigadores/perfiles','Usuarios\InvestigadorController@getRegistrosInvestigadores')->name('getPerfilesInvestigadores');
Route::get('/investigadores/perfil/','Usuarios\InvestigadorController@getInvestigador')->name('verPerfilInvestigador');

Route::get('/investigadores/perfiles/nombres/Ajax','Usuarios\InvestigadorController@getDataAjax')->name('getNombresPerfilesAjax');

/*======================================================================================================
 *==============================  Rutas reservadas para el administrador del sistema ===================
 *    ==========    Todas las rutas en esta seccion se deben proeger con el middleware auth=============
 * =====================================================================================================
 */

Route::get('/riues/home','Administrador\AdminRootController@index')->name('inicioAdministrador');
Route::get('/riues/Administracion/investigadores','Administrador\GestionInvestigadoresController@index')->name('gestionRegistrosInv');
Route::get('/riues/Administracion/investigadores/Ajax','Administrador\GestionInvestigadoresController@getDataAjax')->name('getDataAjax');

Route::resource('/registros','RegistrosController');


Auth::routes();

