/*------------------------------------------------------------------------------------------------------------------
*       |Formulario de actualizacion de usuario.....................................................................
*-------------------------------------------------------------------------------------------------------------------
*/
function verificarSelcArea(campo){
    var c=($('select[name="area"] option:selected').text());


    if (c.trim()=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}

$(function () {
    var url='/get/OtrasAreasAjax';
    var array=[];
    $.ajax({
        type: "get",
        url: url,
        data: {},
        success: function( data )
        {
            console.log(data);
            $.each(data,function (index,value) {
                array.push(value.rt_nombre_area);
            });

            if (array.length >1){
                $('#area-c').autocomplete({
                    source: array
                });
            }else {
                $('#area-c').val('');
                $('#area-c').prop('disabled',true);
            }

        },
        errors:function () {
            alert("no carga nada :|");
        }
    });
});


$('#actualizar').hide();

$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat:"dd-mm-yy",
        yearRange:'-80 :-10',
        changeMonth: true,
        changeYear: true
    });
} );

$('#switch-persona').click(function () {

    if($('#switch-persona').hasClass('inactivo')){
        $('#switch-persona').removeClass('inactivo');
        $('#switch-persona').addClass('activo');
        $('#switch-persona').removeClass('fa-toggle-off');
        $('#switch-persona').addClass('fa-toggle-on');

        $('#actualizar').show();
        $('.edt').prop('disabled',false);
        $("#area").change();

    }else{
        $('#switch-persona').removeClass('fa-toggle-on');
        $('#switch-persona').removeClass('activo');
        $('#switch-persona').addClass('inactivo');
        $('#switch-persona').addClass('fa-toggle-off');

        $('#actualizar').hide();
        $('.edt').prop('disabled',true).removeClass("is-invalid").removeClass("is-valid");
        $('.alert-danger').remove();
    }

});
/*--------------------------------------------------------------------------------------------------------
*   |Funciones de validacion de formularios ..............................................................
*---------------------------------------------------------------------------------------------------------
*/

$('#actualizar').click(function () {
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
    var email=isCorreo($('#correo'));

    if(nom && ape && fech && dir && inst && horas && email ){
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

function isCorreo(campo) {
    var patt=new RegExp(/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i);
    var txt=campo.val();

    if(patt.test(txt) && txt.length> 0){
        campo.addClass('is-valid');
        return true;
    }else{
        campo.addClass('is-invalid');
        return false;
    }
}