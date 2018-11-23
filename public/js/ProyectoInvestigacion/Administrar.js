$( function() {
    $( "#bvt" ).tabs({
        heightStyle:"fill",
        classes:{
            "ui-tabs-tab":"ui-tabs-tab-ctm",
            "ui-tabs-nav":"ui-nav",

        }

    });

} );

$("#area").change();

function verificarSelcArea(campo){
    var c=($('select[name="area"] option:selected').text());


    if (c.trim()=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}

$('button.sw_dp_fr').hide();
$(function ()
{
    if($('#sw_dg').hasClass('activo'))
    {
        $('button.sw_dg_fr').show();
    }else
    {
        $('button.sw_dg_fr').hide();
    }
});

function ActivarForm(id){
    var sw=$('#'+id);
    if(sw.hasClass('inactivo')){

        sw.removeClass('inactivo');
        sw.addClass('activo');
        sw.removeClass('fa-toggle-off');
        sw.addClass('fa-toggle-on');

        var idf=id+"_fr";
        $('#'+idf+' .edt').prop('disabled',false);
        $('button.'+idf).show();
        $("#area").change();
    }else{

        sw.removeClass('activo');
        sw.addClass('inactivo');
        sw.removeClass('fa-toggle-on');
        sw.addClass('fa-toggle-off');

        var idf=id+"_fr";

        $('#'+idf+' .edt').prop('disabled',true);
        $('button.bttn').hide();
        $("#area").change();
    }
}


$(function () {
    $('#form-tabs').tabs();
    $( "#selectable" ).selectable({
        selected:function (event,ui) {

            var clase=ui.selected;
            var clc=clase.id;
            alert(clc);
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
 *  Iniciacion de campos fechas
 *
 */


$( function(){
    $(".fechass").datepicker({
        dateFormat:'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        language: 'es'
    });
} );

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
