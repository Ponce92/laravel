$(document).ready(function () {
    $('div.secciones > div').hide();
    $('div.sub-menu:first').addClass('active');
    $('div.secciones div:first').show();
});

$( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"1950:2018"
    });
} );

$('#reg-btn-1').bind('click',function () {
    $('div.secciones > div').hide();
    $('div.sub-menu:first').removeClass('active');
    $('div.sub-menu:nth-child(2)').addClass('active');
    $('div.secciones div#f2').show();
});

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

