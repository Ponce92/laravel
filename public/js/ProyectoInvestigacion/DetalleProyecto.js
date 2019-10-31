$('#opciones-menu-click').webuiPopover({
    width:350,
    trigger:'click',
    padding:0
});

$("#tipoFuente").change();

function verificarSelcFF(campo){
    var c=($('select[name="tipoFuente"] option:selected').text());


    if (c.trim()=='Otra fuente de Financiamiento'){
        $('#area-f').prop('disabled',false);
    }else {
        $('#area-f').prop('disabled', true);
    }
}
