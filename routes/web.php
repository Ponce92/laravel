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
Route::get('/investigadores/perfiles/detalle/{id}','Usuarios\InvestigadorController@getInvestigador')->name('getPerfilInvestigador');

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
Route::get('/proyectos/ver/detalle/{id}','Usuarios\ProyectosInvestigacionController@VerDetalleProyecto')->name('getProyecto');

/*------------------------------------------------------------------------------------------------------------------------------------
 *      Funcionalidad de la notificacion para todos los usuarios. .  .                                                              --
 * -----------------------------------------------------------------------------------------------------------------------------------
 */
Route::get('/inicio/notificaciones','NotificacionesController@index')->name('notificaciones');
Route::post('/inicio/notificaciones/aceptar','NotificacionesController@aceptarRegistro')->name('notificaciones.aceptar');
Route::post('/inicio/notificaciones/rechazar','NotificacionesController@rechazarRegistro')->name('notificaciones.rechazar');
Route::post('/inicio/notificaciones/eliminar','NotificacionesController@eliminarNotifiacion')->name('notificaciones.eliminar');
Route::post('/inicio/notificaciones/leer','NotificacionesController@marcarLeida')->name('notificaciones.leida');

Route::get('/notificaciones/getNotificacion/ajax','NotificacionesController@getNotificacionesAjax');

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
Route::post('/foros/tematica/respuesta/comentar','Usuarios\TematicaController@Comentar')->name('tematica.comentar');


Route::get('/foros/show/{id}','Usuarios\ForosController@showForo')->name('foros.shows');
Route::get('/respuestas/show/{id}/{idf}','RespuestasController@showRespuestas')->name('respuestas.shows');
Route::get('/foros/eliminar/{id}','Usuarios\ForosController@eliminarTema')->name('eliminar.tema');
Route::get('/respuesta/eliminar/{id}/{idt}','RespuestasController@eliminarRespuesta')->name('eliminar.respuesta');

Route::resource('/respuestas','RespuestasController');

/*---------------------------------------------------------------------------------------------
 *  |    Paises                                                                         -------
 *---------------------------------------------------------------------------------------------
 */

Route::get('riues/ajustes/paises/','Administrador\PaisController@index')->name('ajustes.paises');
Route::get('riues/ajustes/paises/crear/','Administrador\PaisController@getCrear')->name('ajustes.paises.crear.get');
Route::get('riues/ajustes/paises/editar/{id}/','Administrador\PaisController@getEditar')->name('ajustes.paises.editar.get');
Route::post('riues/ajustes/paises/editar/','Administrador\PaisController@Editar')->name('ajustes.paises.editar.post');
Route::post('riues/ajustes/paises/crear/post/','Administrador\PaisController@crear')->name('ajustes.paises.crear.post');

/*---------------------------------------------------------------------------------------------
 *  |    Areas del conocimiento                                                                         -------
 *---------------------------------------------------------------------------------------------
 */

Route::get('admin/ajustes/areas/','Administrador\PaisController@index')->name('areas');
Route::get('admin/ajustes/areas/crear/','Administrador\PaisController@getCrear')->name('areas.crear');
Route::post('admin/ajustes/areas/crear/post/','Administrador\PaisController@crear')->name('areas.creas.post');

Route::get('admin/ajustes/areas/editar/{id}/','Administrador\PaisController@getEditar')->name('areas.editar');
Route::post('admin/ajustes/areas/editar/','Administrador\PaisController@Editar')->name('areas.editar.post');


/*---------------------------------------------------------------------------------------------
 *  |    Grados Academicos                                                              -------
 *---------------------------------------------------------------------------------------------
 */

Route::get('admin/ajustes/grado/','Administrador\GradoController@index')->name('grados');
Route::get('admin/ajustes/grado/crear/','Administrador\GradoController@getCrear')->name('grado.crear');
Route::post('admin/ajustes/grado/crear/post/','Administrador\GradoController@crear')->name('grado.crear.post');

Route::get('admin/ajustes/grado/editar/{id}/','Administrador\GradoController@getEditar')->name('grado.editar');
Route::post('admin/ajustes/grado/editar/','Administrador\GradoController@editar')->name('grado.editar.post');

/*---------------------------------------------------------------------------------------------
 *  |    Modulo de chat en linea  de RIUES                                               -------
 *---------------------------------------------------------------------------------------------
 */
Route::get('/chat','Usuarios\ChatController@Index')->name('chat');
Route::get('/chat/load/json','Usuarios\ChatController@loadJson')->name('chat.load');


// Route::get('/chat','ChatController@index')->name('chat');



Auth::routes();
