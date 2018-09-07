/*------------------------------------------------------------------------------------------------------------------
*       |Formulario de actualizacion de usuario.....................................................................
*-------------------------------------------------------------------------------------------------------------------
*/




$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat:"yy-mm-dd"
    });
} );


/*--------------------------------------------------------------------------------------------------------
*   |Funciones de validacion de formularios ..............................................................
*---------------------------------------------------------------------------------------------------------
*/
$('#btn-frm-registro').bind("click",function () {
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