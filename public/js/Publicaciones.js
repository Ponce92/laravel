function verFormAgregar(){
    $('#agregar-frm').dialog("open");
}

//======================================================================================================================
$('.msj').delay(4000).fadeOut(1000);
//======================================================================================================================
$('#switch-edit').click(function () {

    if($('#switch-edit').hasClass('inactivo')){
        $('#switch-edit').removeClass('inactivo');
        $('#switch-edit').addClass('activo');
        $('#switch-edit').removeClass('fa-toggle-off');
        $('#switch-edit').addClass('fa-toggle-on');

        $('.edt').prop('disabled',false);


    }else{
        $('#switch-edit').removeClass('fa-toggle-on');
        $('#switch-edit').removeClass('activo');
        $('#switch-edit').addClass('inactivo');
        $('#switch-edit').addClass('fa-toggle-off');

        $('.edt').prop('disabled',true).removeClass("is-invalid").removeClass("is-valid");
        $('.alert-danger').remove();
    }

});


function verPublicacion(element) {
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

    $('#id_pu').val(prj.pk_id_publicacion);
    $('#titulo-edt').val(prj.rt_titulo_publicacion);
    $('#fecha-edt').val(prj.rf_fecha_publicacion);

    $('#descripcion-edt').val(prj.rd_descripcion_publicacion);
    $("#enlace-edt").val(prj.rt_enlace_publicacion);
    $("option[value="+prj.fk_id_area+"]").attr('selected',true);
    $("#tipo-edt option").each(function(){
        var valor=$(this).val();

        if (valor==prj.rt_tipo_publicacion){
            $(this).attr('selected',true);
        }
    });


    $( "#editar-frm" ).dialog("open");
}
//======================================================================================================================

function eliminarPublicacion(e) {
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
                    $('input#id_obj').val(e.id);
                    $('form#delete').submit();
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    } );
}

function eliminarLibroP(e) {
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
                    $('input#id_lp').val(e.id);
                    $('form#deleteL').submit();
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    } );
}


//Validacion del formulario de ingreso de publicaciones ...............................................................
function validarFrmEditar(){

    $('#div-err-agregar').html('');
    $('.form-control').removeClass("is-invalid");
    $('.form-control').removeClass("is-valid");

    var fecha=validarFormatoFecha($('#fecha-edt'));
    var titulo=isTextoT($('#titulo-edt'));

    var desc=isTextoD($('#descripcion-edt'));
    var url=validarFormatoUrl($('#enlace-edt'));

    if(fecha && titulo && desc && url){
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

function validarFormatoUrl(campo){
    var txt= campo.val();
    var regx=/^(ftp|http|https):\/\/[^ "]+$/;

    if (txt.length > 2 && regx.test(txt) ) {
        campo.addClass('is-valid');

        return true;
    } else {
        campo.addClass('is-invalid');

        return false;
    }

}

function limpiar(){

    $("input[type='text']").val('');
    $("textarea").html('');
    $("textarea").val('');

    $('#switch-prj-edit').removeClass('fa-toggle-on');
    $('#switch-prj-edit').removeClass('activo');
    $('#switch-prj-edit').addClass('inactivo');
    $('#switch-prj-edit').addClass('fa-toggle-off');


    $('.alert-danger').remove();
    $('.form-control').removeClass("is-invalid");

}


$( function() {
    $ ("#editar-frm").dialog({
            autoOpen: false,
            height: 775,
            width: 675,
            modal:true,
            resizable:false,
            draggable:false,
            classes: {
                "ui-dialog": "my",
                "ui-dialog-titlebar":"frm-modal-title",
                "dialogClass": 'hide-close',
            },
            open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
            buttons: [
                {
                    text: " Guardar ",
                    click: function()
                    {
                        $('#div-error-edit').html('');
                        $('.form-control').removeClass("is-invalid");
                        $('.form-control').removeClass("is-valid");

                        if($('#titulo-edt').attr("disabled")){
                            return false;
                        } else{
                            if(validarFrmEditar()){
                                $('#'+this.id+' form').submit();
                            }else{
                                return false;
                            }

                        }


                    }
                },
                {
                    text: "Cancelar",
                    click: function()
                    {
                        $('#div-error-edit').html('');
                        $('.form-control').removeClass("is-invalid");
                        $('.form-control').removeClass("is-valid");
                        limpiar();
                        $(this).dialog('close');
                    }
                }
            ]
        }
    );
} );
$( function(){
    $("#fecha").datepicker({
        dateFormat:'yy-mm-dd',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true,
        language: 'ES'
    });
    $("#fecha-edt").datepicker({
        dateFormat:'yy-mm-dd',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true
    });
} );