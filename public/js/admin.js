$('#menuSupNtf').webuiPopover();
$('#menuSupMsj').webuiPopover();

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
