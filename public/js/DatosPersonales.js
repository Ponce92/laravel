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
    if ($('#switch-persona').hasClass('inactivo')){
        $('#switch-persona').removeClass('inactivo');
        $('#switch-persona').addClass('activo');
        $('#switch-persona').removeClass('fa-toggle-off');
        $('#switch-persona').addClass('fa-toggle-on');

        /* ................  Se habilitan los campos correspondientes para su edicion................*/
        $('#fotoPersona').removeAttr("disabled");
        $('#nombrePersona').removeAttr("disabled");
        $('#apellidosPersona').removeAttr("disabled");
        $('#datepicker').removeAttr("disabled");
        $('#telefonoPersona').removeAttr("disabled");
        $('#nacionalidadPersona').removeAttr("disabled");
        $('#grado').removeAttr("disabled");
        $('#area').removeAttr("disabled");
        $('#horas').removeAttr("disabled");
        $('#institucion').removeAttr("disabled");
        $('#direccion').removeAttr("disabled");

        $('#btn-frm-persona').prop('disabled',false);

    }else{

        $('#switch-persona').removeClass('fa-toggle-on');
        $('#switch-persona').removeClass('activo');
        $('#switch-persona').addClass('inactivo');
        $('#switch-persona').addClass('fa-toggle-off');

        /* ................  Se deshabilitan los campos correspondientes para su edicion................*/
        $('#fotoPersona').attr("disabled",true);
        $('#nombrePersona').attr("disabled",true);
        $('#apellidosPersona').attr("disabled",true);
        $('#datepicker').attr("disabled",true);
        $('#telefonoPersona').attr("disabled",true);
        $('#nacionalidadPersona').attr("disabled",true);
        $('#grado').attr("disabled",true);
        $('#area').attr("disabled",true);
        $('#horas').attr("disabled",true);
        $('#institucion').prop("disabled",true);
        $('#direccion').attr('disabled',true);

        $('#btn-frm-persona').prop('disabled',true);

    }
});

/*--------------------------------------------------------------------------------------------------------
*   |Funciones de validacion de formularios ..............................................................
*---------------------------------------------------------------------------------------------------------
*/
$('#btn-frm-persona').bind("click",function () {
    event.preventDefault();

    var nombre=isTexto($('#nombrePersona'));
    var apellidos=isTexto($('#apellidosPersona'));
    var fecha=isFecha($('#datepicker'));
    var hora=isHora($('#horas'));
    var direccion=isSoloTexto($('#direccion'));
    var institucion=isSoloTexto($("#institucion"));
    var tel= isSoloNum($('#telefonoPersona'));

    if (nombre && apellidos && fecha && hora && direccion && institucion && tel){

        $('#frm-persona').submit();

    }else{

        $("#mensaje-error-dialog").dialog("open");
    }

});

function isPassword(campo) {
    var txt = campo.val();
    var reg=/^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$/ ;

    if (txt==null || txt.length ==0 || !reg.test(txt)){
        campo.addClass('is-invalid');
        campo.removeClass('is-invalid');
        campo.addClass('is-invalid');
        return false;
    }else {
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');
        campo.addClass('is-valid');
        return true;
    }
}

function isText(campo) {
    var txt = campo.val();
    if (txt==null || txt.length ==0 ){
        campo.addClass('is-invalid');
        campo.removeClass('is-invalid');
        campo.addClass('is-invalid');
        return false;
    }else {
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');
        campo.addClass('is-valid');
        return true;
    }
}

function isTexto(campo) {
    var txt = campo.val();
    var reg=/^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/ ;

    if (txt==null || txt.length ==0 || !reg.test(txt)){
        campo.addClass('is-invalid');
        campo.removeClass('is-invalid');
        campo.addClass('is-invalid');
        return false;
    }else {
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');
        campo.addClass('is-valid');
        return true;
    }
}

function isSoloNum(campo) {
    var txt = campo.val();
    var reg=/^([0-9])*$/;

    if (txt==null || txt.length<7 || !reg.test(txt)){
        campo.addClass('is-invalid');
        campo.removeClass('is-invalid');
        campo.addClass('is-invalid');
        return false;
    }else {
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');
        campo.addClass('is-valid');
        return true;
    }
}

function isHora(campo) {
    txt=campo.val();

    if(campo.val().length == 0 ||campo.val() == null ){
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');

        campo.addClass('is-invalid');

        return false;
    }
    if(isNaN(parseInt(txt))){
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');

        campo.addClass('is-invalid');

        return false;

    }else{
        if(0 < parseInt(txt) && parseInt(txt) < 16){
            campo.removeClass('is-invalid');
            campo.removeClass('is-valid');

            campo.addClass('is-valid');

            return true;
        }else{
            campo.removeClass('is-invalid');
            campo.removeClass('is-valid');

            campo.addClass('is-invalid');
            return false;
        }
    }
}

function isFecha(campo) {
    var txt=campo.val();
    if (txt==null || txt.length==0){
        campo.removeClass('is-valid');
        campo.removeClass('is-invalid');
        campo.addClass('is-invalid');
        return false;
    }else {
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');
        campo.addClass('is-valid');
        return true;
    }
}

function isSoloTexto(campo){
    var txt =campo.val();

    if (txt == null || txt.length <15){
        campo.addClass('is-invalid');
        campo.removeClass('is-invalid');

        campo.addClass('is-invalid');
        return false;
    }else {
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');

        campo.addClass('is-valid');
        return true;
    }

};

$('#mensaje-error-dialog').dialog({
    autoOpen:false,
    width:325,
    height:250,
    modal:false,
    resizable:false,
    position:{

    },
    classes: {
        "ui-dialog": "my",
        "ui-dialog-titlebar":"frm-modal-title",
        "ui-dialog-buttonpane":"db"
    },
    show:{
        effect:"slide",
        duration:400,
        direction:"right",
        time:800,

    },
    buttons:[
        {
            text: " Aceptar ",
            class:"boton-rojo-riues",
            click: function() {
                $( this ).dialog( "close" );
            }
        }
    ],
    position:{
        my: 'right',
        at: 'right bottom',
        of:window
    }



});

$('#msj').dialog({
    width:350,
    height:250,
    modal:false,
    resizable:false,
    position:{

    },
    classes: {
        "ui-dialog": "my",
        "ui-dialog-titlebar":"frm-modal-title",
        "ui-dialog-buttonpane":"db"
    },
    show:{
        effect:"slide",
        duration:400,
        direction:"right",
        time:800,

    },
    buttons:[
        {
            text: " Aceptar ",
            class:"boton-rojo-riues",
            click: function() {
                $( this ).dialog( "close" );
            }
        }
    ],
    position:{
        my: 'right',
        at: 'right bottom',
        of:window
    }



});