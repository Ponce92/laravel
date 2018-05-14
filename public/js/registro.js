/*--------------------------------------------------------------------------------------------------------------------
 *  Funciones del formlario de registro
 *--------------------------------------------------------------------------------------------------------------------
 */

$(document).ready(function () {
    $('div.form').hide();
    $('div.sub-menu:first').addClass('active');
    $('div#f1').show();
});

$('#riues-reg-btn1').bind('click','a',function (e) {
    e.preventDefault();

    var nom=isTexto($('#nombre_txt').val(),$('#nombre_txt'));
    var ape=isTexto($('#apellido_txt').val(),$('#apellido_txt'));
    var email=isEmail($('#email_txt').val(),$('#email_txt'));
    var fecha=isFecha($('#datepicker').val(),$('#datepicker'));
    var sexo=isRadio($("input[name='sexo']"));
    var direccion=isDireccion($('#direccion_txt'));

    if(nom && ape && email && fecha && sexo && direccion ||1){
        $('div.form').hide();
        $('div.sub-menu:first').removeClass('active');
        $('div.sub-menu:nth-child(2)').addClass('active');
        $('div#f2').show();
    }

});

$('#riues-reg-btn2').bind('click','a',function (e) {
    e.preventDefault();

    var sel1=isSelect($('#pais'));
    var sel2=isSelect($('#grado'));
    var foto=isFoto($('#inputFile'));


    if(sel1 && sel2 && foto && 0){
        $('div.form').hide();
        $('div.sub-menu:nth-child(2)').removeClass('active');
        $('div.sub-menu:nth-child(3)').addClass('active');
        $('div#f3').show();
    }
});

$('#riues-reg-btn3').bind('click','a',function (e) {
    e.preventDefault();
    $('form').submit();
});

$('#riues-reg-btn33').bind('click','a',function (e) {
    e.preventDefault();

    $('div.form').hide();
    $('div.sub-menu:nth-child(3)').removeClass('active');
    $('div.sub-menu:nth-child(2)').addClass('active');
    $('div#f2').show();
});

$('#riues-reg-btn22').bind('click','a',function (e) {
    e.preventDefault();

    $('div.form').hide();
    $('div.sub-menu:first').addClass('active');
    $('div.sub-menu:nth-child(2)').removeClass('active');
    $('div#f1').show();
});


/*--------------------------------------------------------------------------------------------------------------------
 *  Funciones de tratamiento de la imgen en el fomulario
 *--------------------------------------------------------------------------------------------------------------------
 */
function mostrarImagen(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_destino').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#file_url").change(function(){
    mostrarImagen(this);
});



/*--------------------------------------------------------------------------------------------------------------------
 *  Funciones de Jquery- ui
 *--------------------------------------------------------------------------------------------------------------------
 */

$( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"1950:2018"
    });
} );

/*--------------------------------------------------------------------------------------------------------------------
 *  Validaciones del formulario y consultas Ajax.
 *--------------------------------------------------------------------------------------------------------------------
 */
function isDireccion(campo) {
    var txt=campo.val();

    if(txt==null ||txt.length==0){
        campo.removeClass('is-valid');
        campo.removeClass('is-invalid');
        campo.addClass('is-invalid');
        return false;
    }else{
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');
        campo.addClass('is-valid');
        return true;
    }
}
function isTexto(txt,campo) {
    var reg=/^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/ ;

    if (txt==null || txt.length==0 || !reg.test(txt)){
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
function isEmail(txt,campo) {
    var reg=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;

    if (txt==null || txt.length==0 || !reg.test(txt)){
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
function isFecha(txt,campo) {
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
function isRadio(radio) {

    if (radio.is(':checked')){
        radio.removeClass('is-invalid');
        radio.removeClass('is-valid');
        radio.addClass('is-valid');
        return true;
    }else {
        radio.removeClass('is-valid');
        radio.removeClass('is-invalid');
        radio.addClass('is-invalid');
        return false;
    }


}
function isSelect(select) {
    if(select.val().trim()==='000'){
        select.removeClass('is-valid');
        select.removeClass('is-invalid');
        select.addClass('is-invalid');
        return false;
    }else{
        select.removeClass('is-valid');
        select.removeClass('is-invalid');
        select.addClass('is-valid');
        return true;
    }

}

function isFoto(campo){
    if (!campo.val()){
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
function isHora(campo) {

    if(campo.val().length == 0 ||campo.val()==null ){
        campo.removeClass('is-invalid');
        campo.removeClass('is-valid');

        campo.addClass('is-invalid');
        return false;
    }
    if(isNaN(parseInt(campo.value))){

    }else{
        if(0 < parseInt(campo.value) <24){
            campo.removeClass('is-invalid');
            campo.removeClass('is-valid');
            campo.addClass('is-valid');
            return true;
        }
    }
    return false;
}