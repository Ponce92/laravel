/*------------------------------------------------------------------------------------------------------------------
*       |Formulario de actualizacion de usuario.....................................................................
*-------------------------------------------------------------------------------------------------------------------
*/

$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat:"yy-mm-dd"
    });
} );

$('#switch-persona').click(function () {

    if($('#switch-persona').hasClass('inactivo')){
        $('#switch-persona').removeClass('inactivo');
        $('#switch-persona').addClass('activo');
        $('#switch-persona').removeClass('fa-toggle-off');
        $('#switch-persona').addClass('fa-toggle-on');

        $('.edt').prop('disabled',false);


    }else{
        $('#switch-persona').removeClass('fa-toggle-on');
        $('#switch-persona').removeClass('activo');
        $('#switch-persona').addClass('inactivo');
        $('#switch-persona').addClass('fa-toggle-off');

        $('.edt').prop('disabled',true).removeClass("is-invalid").removeClass("is-valid");
        $('.alert-danger').remove();
    }

});
/*--------------------------------------------------------------------------------------------------------
*   |Funciones de validacion de formularios ..............................................................
*---------------------------------------------------------------------------------------------------------
*/

$('#btn-riues').click(function () {
        event.preventDefault();
        $('#error').html('');
    $('#status').html('');

        $($('.edt')).removeClass('is-invalid');
        $($('.edt')).removeClass('is-valid');

        $('#pais').addClass('is-valid');
        $('#area').addClass('is-valid');
        $('#grado').addClass('is-valid');
       if(validarForm()){
            $('#form').submit();
       }else{

           $('#error').html('<div class="alert alert-danger">' +'Existen campos con errores en el formulario, porfavor corrijalos.'+
               '</div>');
           return false;
       }

});



function validarForm() {
    var nom=isNombre($('#nombres'));
    var ape=isNombre($('#apellidos'));
    var fech=isNoNull($('#datepicker'));
    var dir=isNoNull($('#direccion'));
    var inst=isNoNull($('#institucion'));
    var horas=isHoras($('#horas'));

    if(nom && ape && fech && dir && inst ){
        return true;
    }else{
        return false;
    }
}

function isNoNull(campo) {

    var txt=campo.val();

    if(txt.length > 9){
        campo.addClass('is-valid');
        return true;
    }else{
        campo.addClass('is-invalid')
        return false;
    }
}

function isNombre(campo) {
    var patt=new RegExp(/^[A-Za-z\s]+$/);
    var txt=campo.val();

    if(patt.test(txt) && txt.length> 0){
        campo.addClass('is-valid');
        return true;
    }else{
        campo.addClass('is-invalid');
        return false;
    }
}

function isHoras(campo) {
    var txt=campo.val();

    if(txt.length > 0 && parseInt(txt) > 0 && parseInt(txt) < 12){
        campo.addClass('is-valid');
        return true;
    }else{
        campo.addClass('is-invalid');
        return false;
    }
}