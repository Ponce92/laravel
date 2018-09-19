
$("#area").change();

function verificarSelcArea(campo){

    var c=    campo.options[campo.value];
    if (c.text=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}

$( function(){

    $("#fechaI,#fechaF").datepicker({
        dateFormat:'dd-mm-yy',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true,
        language: 'ES'
    });
} );
