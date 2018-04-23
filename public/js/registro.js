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

    $('div.form').hide();
    $('div.sub-menu:first').removeClass('active');
    $('div.sub-menu:nth-child(2)').addClass('active');
    $('div#f2').show();
});

$('#riues-reg-btn2').bind('click','a',function (e) {
    e.preventDefault();

    $('div.form').hide();
    $('div.sub-menu:nth-child(2)').removeClass('active');
    $('div.sub-menu:nth-child(3)').addClass('active');
    $('div#f3').show();
});
$('#riues-reg-btn3').bind('click','a',function (e) {
    e.preventDefault();
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