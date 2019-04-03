$(function () {
    $( "#selectable" ).selectable({
        selected:function (event,ui) {

            var clase=ui.selected;
            var clc=clase.id;


            $('#idInconoTxt').val(clc);


            $('#iconDestini').removeClass();
            $('#iconDestini').removeAttr('name');

            $('#iconDestini').attr('name',clc);

            $('#iconDestini').addClass(clc);
            $('#iconDestini').addClass('fa-5x');
            $('#colorIcon').prop('selectedIndex',0);
        }
    });
});

/*
 Funcion que reconstruye el valor que se ha selecionado en el selectable de ui....

 Funcionamiento: Se obtiene el valor del atributo nombre  que es el icono que se ha seleccionado en el selectable
                 luego se resetea el div y se agrega el valor que tenia anteriormente
                 y se agrega la clase que corresponde al color seleccionado....

 */

$('#colorIcon').on('change',function () {
    var divv=$('#iconDestini');
    var ant=divv.attr('name');

    var color = $('option:selected', $('#colorIcon')).attr("name");

    // var c=$('#selectable').selectable('option');

    divv.removeClass();

    divv.addClass(ant);
    $('#iconDestini').addClass('fa-5x');
    divv.addClass(color);

});

/*Funcionamiento que del formulario
 */
$('#actualizar').hide();

$('#switch').click(function () {

    if($('#switch').hasClass('inactivo')){
        $('#switch').removeClass('inactivo');
        $('#switch').addClass('activo');
        $('#switch').removeClass('fa-toggle-off');
        $('#switch').addClass('fa-toggle-on');

        $('#actualizar').show();
        $('.edt').prop('disabled',false);
        $("#area").change();

    }else{
        $('#switch').removeClass('fa-toggle-on');
        $('#switch').removeClass('activo');
        $('#switch').addClass('inactivo');
        $('#switch').addClass('fa-toggle-off');

        $('#actualizar').hide();
        $('.edt').prop('disabled',true).removeClass("is-invalid").removeClass("is-valid");
        $('.alert-danger').remove();
    }

});

/*---------------------------------------------------------------------------------
 *  Formularios de la pagina
 *---------------------------------------------------------------------------------
 */

$('#tipo_proyecto').change(function () {
    $('#filtrar').submit();
});