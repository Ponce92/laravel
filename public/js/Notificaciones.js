function rechazarUsuario(id) {
    $('#codigo_rechazar').val(id);
    $('#frm_rechazar').submit();
}

function aceptarUsuario(id) {
    $('#codigo_aceptar').val(id);

    $('#frm_aceptar').submit();
}

function eliminarNotificacion(id) {
    $('#codigo_eliminar').val(id);

    $('#frm_eliminar').submit();
}

function leerNotificacion(id) {
    $('#codigo_leida').val(id);
    $('#frm_leida').submit();
}