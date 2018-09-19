// $( function() {
//     $ ("#frm-agregar").dialog({
//             autoOpen: false,
//             height: 800,
//             width: 675,
//             modal:true,
//             appendTo:'.addToJq',
//             resizable:false,
//             classes: {
//                 "ui-dialog": "my",
//                 "ui-dialog-titlebar":"frm-modal-title",
//                 "dialogClass": 'hide-close',
//             },
//             open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
//             buttons: [
//                 {
//                     text: " Guardar ",
//                     click: function()
//                     {
//                         $('#errores').html('');
//                         $('.form-control').removeClass("is-invalid");
//                         $('.form-control').removeClass("is-valid");
//                         if(validarFrmAgregar()){
//
//                             $('#'+this.id+' form').submit();
//                         }else{
//                             return false;
//                         }
//
//
//                     }
//                 },
//                 {
//                     text: "Cancelar",
//                     click: function()
//                     {
//                         $('#errores').html('');
//                         $('.form-control').removeClass("is-invalid");
//                         $('.form-control').removeClass("is-valid");
//                         limpiar();
//                         $(this).dialog('close');
//                     }
//                 }
//             ]
//         }
//     );
// } );

// $( function() {
//     $ ("#frm-act").dialog({
//             autoOpen: false,
//             height: 700,
//             width: 675,
//             modal:true,
//             resizable:false,
//             draggable:false,
//             classes: {
//                 "ui-dialog": "my",
//                 "ui-dialog-titlebar":"frm-modal-title",
//                 "dialogClass": 'hide-close',
//             },
//             open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
//             buttons: [
//                 {
//                     text: " Actualizar ",
//
//                     click: function() {
//                         if(validarFrmActualizar()){
//                             if($('#nombre-edt').attr("disabled")){
//                                 $('.form-control').removeClass('is-valid');
//                                 return false;
//                             }else {
//                                 $('#'+this.id+' form').submit();
//                             }
//
//                         }else{
//                             $('#errores').html('');
//                             $('.form-control').removeClass("is-invalid");
//                             $('.form-control').removeClass("is-valid");
//                             return false;
//                         }
//
//                     }
//                 },
//                 {
//                     text: "Cancelar",
//                     click: function()
//                     {
//                         limpiar();
//                         $(this).dialog('close');
//                     }
//                 }
//             ]
//         }
//     );
// } );

// function verDialogFrm(){
//     $( "#frm-agregar" ).dialog("open");
// }



$( function(){
    $("#fechaInicio-edt,#fechafin-edt").datepicker({
        dateFormat:'dd-mm-yy',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true,
        language: 'es'
    });

    $("#fechaI,#fechaF").datepicker({
        dateFormat:'dd-mm-yy',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true,
        language: 'ES'
    });
} );

$('#area-personalizada').hide();

function mostrarD(e){
//    var op=e.options[select.selectedIndex];

    if (e.value==-1){
        $('#area-personalizada').show();
    } else{
        $('#area-personalizada').hide();
    }
}

/*-------------------------------------------------------------------------------------------------------|
*   | Eventos correspondientes a la actualizacion de los proyectos realizados............................|
*--------------------------------------------------------------------------------------------------------|
*/
$('#switch-prj-edit').click(function () {

    if($('#switch-prj-edit').hasClass('inactivo')){
        $('#switch-prj-edit').removeClass('inactivo');
        $('#switch-prj-edit').addClass('activo');
        $('#switch-prj-edit').removeClass('fa-toggle-off');
        $('#switch-prj-edit').addClass('fa-toggle-on');

        $('.edt').prop('disabled',false);

        $('#btn-usuario').prop('disabled',false);

    }else{
        $('#switch-prj-edit').removeClass('fa-toggle-on');
        $('#switch-prj-edit').removeClass('activo');
        $('#switch-prj-edit').addClass('inactivo');
        $('#switch-prj-edit').addClass('fa-toggle-off');

        $('.edt').prop('disabled',true).removeClass("is-invalid");

        $('#btn-usuario').prop('disabled',true);
        $('.invalid-feedback').html('');
        $('.alert-danger').remove();
    }

});

function verProyecto(element) {
    var url=element.getAttribute('name');
    var id=element.getAttribute('id');

    getDetalle(id,url);
    //var data=getDetalle(parseInt(element.id));

}

function getDetalle(id,url) {
    $.ajax({
        type: "get",
        url: url,
        data: {id: id},
        success: function( prj )
        {
            mostrarFormEdit(prj[0]);
        }
    });
}

function mostrarFormEdit(prj) {
    $('#id').val(prj.pk_id_proyecto);
    $('#nombre-edt').val(prj.rt_titulo_proyecto);
    $('#fechaInicio-edt').val(prj.rf_fecha_inicio_proyecto);
    $('#fechafin-edt').val(prj.rf_fecha_fin_proyecto);
    $('#area-edt').append('<option selected value="'+prj.pk_id_area+'"+ >'+prj.rt_nombre_area+' </option>');

    $('#textarea-edt').val(prj.rd_descripcion_proyecto);

    $( "#frm-act" ).dialog("open");
}

function limpiar(){
    $("input[type='text']").val('');
    $("select#area-edt").html('');
    $("textarea").html('');
    $('.form-control').removeClass("is-invalid");
    $('.form-control').removeClass("is-valid");


    $('#switch-prj-edit').removeClass('fa-toggle-on');
    $('#switch-prj-edit').removeClass('activo');
    $('#switch-prj-edit').addClass('inactivo');
    $('#switch-prj-edit').addClass('fa-toggle-off');

    $('.edt').prop('disabled',true).removeClass("is-invalid");
    $('.edt').val('');

    $('#btn-usuario').prop('disabled',true);
    $('.alert-danger').remove();
    $('.form-control').removeClass("is-invalid");
    $("textarea").html('');
    $("textarea").val('');

}

/*-------------------------------------------------------------------------------------------------------|
*   | Eventos correspondientes a la eliminacion de un formulario............................|
*--------------------------------------------------------------------------------------------------------|
*/

function eliminarProyecto(e) {
    $( function() {
        $( "#conf" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,

            classes: {
                "ui-dialog": "my",
                "ui-dialog-titlebar":"frm-modal-title",
                "dialogClass": 'hide-close',
            },
            open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
            buttons: {
                "Eliminar": function() {
                    $('input#idd').val(e.id);
                    $('form#delete').submit();
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    } );
}

/*-------------------------------------------------------------------------------------------------------|
*   | Validacion de formularios..........................................................................|
*--------------------------------------------------------------------------------------------------------|
*/
function validarFrmActualizar(){

    $('#div-error-edit').html('');
    $('.form-control').removeClass("is-invalid");
    $('.form-control').removeClass("is-valid");

    var fechas=valFechas($('#fechaInicio-edt'),$('#fechafin-edt'));
    var titulo=isTextoT($('#nombre-edt'));
    var desc=isTextoD($('#textarea-edt'));

    if(fechas && titulo && desc){
        return true;
    }else{
        $('#div-error-edit').append(
            '<div class=" alert alert-danger">'+
            '<i class="fas fa-exclamation-triangle">&nbsp;&nbsp;</i>' + 'El formulario contiene errores !' +
            '</div>'
        );
        return false;
    }
}

function validarFrmAgregar(){

    var fechas=valFechas($('#fechaInicio'),$('#fechaFin'));
    var titulo=isTextoT($('#nombreArea-crt'));
    var desc=isTextoD($('#descripcion'));

    if(fechas && titulo && desc){
        return true;
    }else{
        $('#errores').append(
            '<div class=" alert alert-danger">'+
            '<i class="fas fa-exclamation-triangle">&nbsp;&nbsp;</i>' + 'El formulario contiene errores !' +
            '</div>'
        );
        return false;
    }
}

function isTextoT(campo) {
    var txt = campo.val();

    if (txt==null || txt.length < 6 || txt.length > 100){
        campo.addClass('is-invalid');

        return false;
    }else {
        campo.addClass('is-valid');
        return true;
    }
}

function isTextoD(campo) {
    var txt = campo.val();

    if (txt==null || txt.length<4 ||txt.length >150){
        campo.addClass('is-invalid');
        return false;
    }else {
        campo.addClass('is-valid');

        return true;
    }
}

function valFechas(f1,f2) {
    var vf2=validarFormatoFecha(f2);
    var vf1=validarFormatoFecha(f1);


    if(vf1 && vf2){
        return true;
    }else {
        return false;
    }
}

function validarFormatoFecha(campo) {
    var txt=campo.val();
    if (txt.length > 2) {
        campo.addClass('is-valid');

        return true;
    } else {
        campo.addClass('is-invalid');

        return false;
    }
}
