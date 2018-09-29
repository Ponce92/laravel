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
Route::get('/investigadores/perfiles/detalle/{id}','Usuarios\InvestigadorController@getInvestigador');

Route::get('/investigadores/perfiles/nombres/Ajax','Usuarios\InvestigadorController@getDataAjax')->name('getNombresPerfilesAjax');


/*
 *  |Rutas para la gestion de proyectos de investigacion ...............................................................
 */

Route::get('/proyectos/busqueda','Usuarios\ProyectosInvestigacionController@index')->name('busqueda.proyectos.investigacion');

Route::get('/proyectos/mis-proyectos','Usuarios\ProyectosInvestigacionController@obtenerProyectos')->name('misproyectos.investigacion');
Route::get('/proyectos/mis-proyectos/{id}','Usuarios\ProyectosInvestigacionController@detalleProyecto');


Route::get('/proyectos/registrar','Usuarios\ProyectosInvestigacionController@registrarForm')->name('registrar.proyectos.investigacion.form');
Route::post('/proyectos/registrar','Usuarios\ProyectosInvestigacionController@registrar')->name('registrar.proyecto.investigacion');

Route::get('/proyectos/actualizar','Usuarios\ProyectosInvestigacionController@actualizar')->name('actualizar.proyectos.investigacion');


Route::get('/inicio/notificaciones','NotificacionesController@index')->name('notificaciones');




/*======================================================================================================
 *==============================  Rutas reservadas para el administrador del sistema ===================
 *    ==========    Todas las rutas en esta seccion se deben proeger con el middleware auth=============
 * =====================================================================================================
 */

Route::get('/riues/home','Administrador\AdminRootController@index')->name('inicioAdministrador');



/*
 | Experimental
 |
*/

Route::get('/riues/investigadores','Riues\InvestigadoresController@index')->name('investigadores');

Route::get('/riues/investigadores/getdata','Riues\InvestigadoresController@getdata')->name('investigadores.getdata');


/*
 |
 |
*/
Route::get('/riues/Administracion/investigadores','Administrador\GestionInvestigadoresController@index')->name('gestionRegistrosInv');
Route::get('/riues/Administracion/investigadores/Ajax','Administrador\GestionInvestigadoresController@getDataAjax')->name('getDataAjax');

Route::resource('/registros','RegistrosController');


Auth::routes();

