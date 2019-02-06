$('#menuSupNtf').webuiPopover(
    {
        placement:'bottom-left',
        multi:false,
        container:'#barraS'

    }
);
$('#menuSupMsj').webuiPopover({
    placement:'bottom-left',
    multi:false,
    container:'#barraS'
});




$('#menuSupNtf').on('click',function () {
    $.ajax({
        url : '/notificaciones/getNotificacion/',
        type:'get',
        dataType:'json',
        success:function (data) {
            $('#menuNtf').html(data);
        },
        error:function (xhr,status) {
            $('#menuNtf').html("<strong>Servidor no encontrado</strong>")
        }
    });
});

/*
    botones de help de los formularios          ...........................
 */

$('.help-rc').webuiPopover({
    width:300,
    style:'inverse',
    trigger:'hover'
});

$(document).ready(function() {
    setTimeout(function() {
        $(".msj").fadeOut(1200);
    },3000);
});
