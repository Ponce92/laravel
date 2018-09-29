
$("#area").change();

function verificarSelcArea(campo){
    var c=($('select[name="area"] option:selected').text());


    if (c.trim()=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}

$(function () {
   $('#ff').datepicker({
       dateFormat:"yy-mm-dd"
   });
    $('#fi').datepicker({
        dateFormat:"yy-mm-dd"
    });
});

/*
    |           Funciones de jquery ui  ......................................
 */

$(function () {
    $('#form-tabs').tabs();
    $( "#selectable" ).selectable({
        selected:function (event,ui) {

            var clase=ui.selected;
            var clc=clase.id;

            $('#idInconoTxt').val('clc');
            $('#iconDestini').removeClass();
            $('#iconDestini').removeAttr('name');

            $('#iconDestini').attr('name',clc);

            $('#iconDestini').addClass(clc);
            $('#iconDestini').addClass('fa-5x');
            $('#colorIcon').prop('selectedIndex',0);
        }
    });
});

$('#colorIcon').on('change',function () {
    var divv=$('#iconDestini');
    var ant=divv.attr('name');


    var id=$('#colorIcon').val();
    var c=$('#selectable').selectable('option');
    console.log(c);
    divv.removeClass();

    divv.addClass(ant);
    $('#iconDestini').addClass('fa-5x');
    divv.addClass(id);

});
