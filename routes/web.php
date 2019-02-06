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



//Route::post('/registro','RegistroController@postRegistro');
//Route::get('/registro','RegistroController@getRegistro');
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

Route::get('/proyectos/busqueda','Usuarios\ProyectosInvestigacionController@BusquedaProyectos')->name('Busqueda.Proyectos');
Route::get('/proyectos/busqueda/detalle','Usuarios\ProyectosInvestigacionController@BusquedaProyectos')->name('proyecto.buscar.detalle');
Route::get('/proyectos/busqueda/detalle/{id}','Usuarios\ProyectosInvestigacionController@BusquedaProyectos');

Route::get('/proyectos/mis-proyectos','Usuarios\ProyectosInvestigacionController@obtenerProyectos')->name('misproyectos.investigacion');
Route::get('/proyectos/mis-proyectos/{id}','Usuarios\ProyectosInvestigacionController@detalleProyecto');
Route::post('/Proyectos/actualizar/general/','Usuarios\ProyectosInvestigacionController@ActualizarDatosGenerales')->name('proyecto.investigacion.actualizar');


Route::get('/proyectos/registrar','Usuarios\ProyectosInvestigacionController@registrarForm')->name('registrar.proyectos.investigacion.form');
Route::post('/proyectos/registrar','Usuarios\ProyectosInvestigacionController@registrar')->name('registrar.proyecto.investigacion');

Route::get('/proyectos/actualizar','Usuarios\ProyectosInvestigacionController@actualizar')->name('actualizar.proyectos.investigacion');
Route::post('/proyecto/actualizar','Usuarios\ProyectosInvestigacionController@ActualizarDetalle')->name('proyecto.actualizar');

Route::get('/proyectos/ver/detalle','Usuarios\ProyectosInvestigacionController@VerDetalleProyecto')->name('ver.detalle.proyecto');
Route::get('/proyectos/ver/detalle/{id}','Usuarios\ProyectosInvestigacionController@VerDetalleProyecto');

/*------------------------------------------------------------------------------------------------------------------------------------
 *      Funcionalidad de la notificacion para todos los usuarios. .  .                                                              --
 * -----------------------------------------------------------------------------------------------------------------------------------
 */
Route::get('/inicio/notificaciones','NotificacionesController@index')->name('notificaciones');
Route::post('/inicio/notificaciones/aceptar','NotificacionesController@aceptarRegistro')->name('notificaciones.aceptar');
Route::post('/inicio/notificaciones/rechazar','NotificacionesController@rechazarRegistro')->name('notificaciones.rechazar');
Route::post('/inicio/notificaciones/eliminar','NotificacionesController@eliminarNotifiacion')->name('notificaciones.eliminar');
Route::post('/inicio/notificaciones/leer','NotificacionesController@marcarLeida')->name('notificaciones.leida');


/*-------------------------------------------------------------------------------------------------------------------------------
 |      rutas para la admiistracion de solicitudes vairas
 |-------------------------------------------------------------------------------------------------------------------------------
 */

Route::post('/investigadores/solicitar/reactivacion','Usuarios\InvestigadorController@SolicitarReactivacion')->name('notificacion.reactivacion');
Route::post('/investigadores/solicitar/amistad','NotificacionesController@SolicitarAmistad')->name('solicitar.amistad');
Route::post('/investigadores/responder/amistad','NotificacionesController@ResponderSolicitudAmistad')->name('responder.amistad');

Route::post('/investigadores/solicitar/anexion','NotificacionesController@SolicitudAnexion')->name('solicitar.proyecto.union');
Route::post('/investigadores/responder/anexion','NotificacionesController@ResponderAnexion')->name('responder.invitacion.proyecto');

Route::post('/investigadores/solicitar/participacion','NotificacionesController@SolicitarParticipacionProyecto')->name('solicitar.participar.proyecto');
Route::post('/investigadores/responder/participacion/proyecto','NotificacionesController@ResponderParticipacionProyecto')->name('esponder.participar.proyecto');


/*-------------------------------------------------------------------------------------------------------------------------------------
 *  |Administracion de redes de investigadores                                                                                  -------
 *-------------------------------------------------------------------------------------------------------------------------------------
 */
Route::get('/inicio/redes/investigador','Usuarios\RedController@index')->name('redes.todas');

Route::get('/inicio/redes/investigador/detalle/{id}','Usuarios\RedController@obtenerDetalleRed');
Route::post('/inicio/redes/investigador/act','Usuarios\RedController@actualizarRed')->name('act.red');

Route::get('/inicio/redes/busqueda','Usuarios\RedController@busquedaRedes')->name('redes.busqueda');
Route::get('/inicio/redes/busqueda/detalle/{id}','Usuarios\RedController@detalleRed');


/*---------------------------------------------------------------------------------------------
 *  |Administracion de Documentos de proyectos                                          -------misproyectos.documentos
 *---------------------------------------------------------------------------------------------
 */
Route::get('/proyecto/documentos/','Usuarios\DocumentosController@Index')->name('proyecto.gestion.documentos');
Route::get('/proyecto/documentos/{id}','Usuarios\DocumentosController@Index');
Route::post('/proyecto/documentos/agregar','Usuarios\DocumentosController@AgregarDocumento')->name('documento.agregar');
Route::get('/proyecto/documentos/descargar/','Usuarios\DocumentosController@DocumentoDescargar')->name('documentos.download');
Route::get('/proyecto/documentos/descargar/{id}','Usuarios\DocumentosController@DocumentoDescargar');
Route::get('/proyecto/documentos/eliminar/','Usuarios\DocumentosController@DocumentoDelete')->name('documento.eliminar');
Route::get('/proyecto/documentos/eliminar/{id}','Usuarios\DocumentosController@DocumentoDelete');



/*---------------------------------------------------------------------------------------------
 *  |                                                         -------
 *---------------------------------------------------------------------------------------------
 */

Route::get('/get/OtrasAreasAjax','Ajax\AjaxController@getOtrasAreas')->name('get.otras.areas');



/*======================================================================================================
 *==============================  Rutas reservadas para el administrador del sistema ===================
 *    ==========    Todas las rutas en esta seccion se deben proeger con el middleware auth=============
 * =====================================================================================================
 */

Route::get('/riues/home','Administrador\AdminRootController@index')->name('inicioAdministrador');



Route::get('/riues/investigadores','Riues\InvestigadoresController@index')->name('investigadores');

Route::get('/riues/investigadores/getData','Riues\InvestigadoresController@getdata')->name('investigadores.getdata');


/*
 |
 |
*/
Route::get('/riues/Administracion/investigadores','Administrador\GestionInvestigadoresController@index')->name('gestionRegistrosInv');
Route::get('/riues/Administracion/investigadores/Ajax','Administrador\GestionInvestigadoresController@getDataAjax')->name('getDataAjax');

Route::resource('/registros','RegistrosController');
/*---------------------------------------------------------------------------------------------
 *  |Rutas de Foros y mensajes                                          -------
 *---------------------------------------------------------------------------------------------
 */
Route::get('/foros','Usuarios\ForosController@index')->name('foros');
Route::get('/foros/tematicas/crear/{id}','Usuarios\TematicaController@getCrear')->name('tematicas.crear');
Route::post('/foros/tematicas/crear/','Usuarios\TematicaController@Crear')->name('tematicas.guardar');
Route::get('/foros/tematicas/{id}','Usuarios\TematicaController@Index')->name('tematicas.index');
Route::get('/foros/tematica/ver/{id}','Usuarios\TematicaController@Show')->name('tematica.Index');
Route::get('/foros/tematica/respuesta/agregar/{id}','Usuarios\TematicaController@agregarRespuesta')->name('tematica.respuesta.form');
Route::post('/foros/tematica/respuesta/agregar','Usuarios\TematicaController@Responder')->name('tematica.respuesta');


Route::get('/foros/show/{id}','Usuarios\ForosController@showForo')->name('foros.shows');
Route::get('/respuestas/show/{id}/{idf}','RespuestasController@showRespuestas')->name('respuestas.shows');
Route::get('/foros/eliminar/{id}','ForosController@eliminarTema')->name('eliminar.tema');
Route::get('/respuesta/eliminar/{id}/{idt}','RespuestasController@eliminarRespuesta')->name('eliminar.respuesta');

Route::resource('/respuestas','RespuestasController');

/*
 |
 |
*/
Route::get('/chat','ChatController@index')->name('chat');



Auth::routes();

