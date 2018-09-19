
$("#area").change();
$("#tipo").change();

function verificarSelcArea(campo){
   var c=($('select[name="area"] option:selected').text());


    if (c.trim()=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}


function verificarSelcTipo(campo){
    var c=campo.value;
    if (c=='libro'){

        $('#issn').prop('disabled',false);
        $('#np').prop('disabled',false);
        $('#nc').prop('disabled',false);
        $('#enlace').prop('disabled',true);

    }else {

        $('#issn').prop('disabled', true);
        $('#nc').prop('disabled', true);
        $('#np').prop('disabled', true);
        $('#enlace').prop('disabled',false);
    }
}


$( function(){

    $("#fecha").datepicker({
        dateFormat:'dd-mm-yy',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true,
        language: 'ES'
    });
} );
