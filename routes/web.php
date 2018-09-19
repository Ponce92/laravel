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

Route::get('/perfil/proyectosRealizados/','ProyectosRealizadosController@verProyectos')->name('gestionProyectosRealizados');
Route::get('/perfil/proyectosRealizados/agregar/','ProyectosRealizadosController@agregarProyectoForm')->name('agregarProyectosRealizadoForm');
Route::post('/perfil/crear/proyectosRealizados/','ProyectosRealizadosController@agregarProyecto')->name('agregarProyectosRealizado');
Route::get('/perfil/proyectosRealizados/editar/{id}','ProyectosRealizadosController@editarProyectoForm')->name('getDetalleProyectoRealizado');
Route::post('/perfil/proyectosRealizados/editar/{id}','ProyectosRealizadosController@editarProyecto')->name('EditarProyectosRealizado');

Route::post('/perfil/eliminar/proyectosRealizados','ProyectosRealizadosController@eliminarProyecto')->name('eliminarProyectosRealizado');


/*======================================================================================================
 *=====================================      Publicaciones realizados ==================================
 * =====================================================================================================
 */

Route::get('/perfil/publicaciones','Usuarios\PublicacionesController@verPublicaciones')->name('verPublicaciones');

Route::get('/perfil/publicacion/agregar','Usuarios\PublicacionesController@agregarPublicacionForm')->name('agregarPublicacionForm');
Route::post('/perfil/publicacion/agregar','Usuarios\PublicacionesController@agregarPublicacion')->name('agregarPublicacion');
Route::post('/perfil/eliminar/publicacion','Usuarios\PublicacionesController@eliminarPublicacion')->name('eliminarPublicacion');
Route::post('/perfil/publicacion/elimina/libroPublicado','Usuarios\PublicacionesController@eliminarLibroPublicado')->name('eliminarLibroPublicado');

Route::get('/perfil/publicaciones/editar/{id}','Usuarios\PublicacionesController@actualizarPublicacionForm');
Route::get('/perfil/publicaciones/editar/libro/{id}','Usuarios\PublicacionesController@actualizarPublicacionLibroForm');

Route::post('/perfil/publicaciones/editar/','Usuarios\PublicacionesController@actualizarPublicacion')->name('editarPublicacion');
Route::post('/perfil/publicaciones/editar/libro/','Usuarios\PublicacionesController@actualizarPublicacionLibro')->name('editarPublicacionLibro');

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

