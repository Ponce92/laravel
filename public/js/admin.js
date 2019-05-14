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
        url : '/notificaciones/getNotificacion/ajax',
        type:'get',
        success:function (data) {
            console.log(data);
            $('#menuNtf').html(data.html);
        },
        error:function (xhr,status) {
            $('#menuNtf').html("<strong>Servidor no encontrado  ..!!</strong>")
        }
    });
});

/*
        |botones de help de los formularios          ...........................
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
