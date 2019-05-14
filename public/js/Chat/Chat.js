
var codigo_usuario=$('#sendMsj').attr('codigo-user');
var url_load=$('#messages').attr("url");

function loadDivMjs(id){

    $.ajax({
        url: url_load,
        data:{
            id:id
        },
        success:function (data) {
            $("#targetChat").html(data.html);
            $("#block-msj").scrollTop(10000);

        }
    });

    str='usr-'+id;
    $('#'+str).removeClass("nv");
}
// Funciones de conexion al servidor node js:
try {
    var socket = io.connect('http://localhost:8080', {
        'forceNew': true
     });
} catch (e) {
    alert('Servidor no disponible');
    location.href="/dashboard";
}


// Funciones de envio de datos al server
function sendMensaje(){

    var mensaje=$('#chtInput').val();

    if(mensaje.length>0){
        var data={
            msj:mensaje,
            remitente:codigo_usuario,
            destinatario:$('#msj-destino').attr('destinatario')
        }
        socket.emit('mensaje',data);
        $('#chtInput').val('');
    }else{

        $('#chtInput').focus();
    }
}

socket.on('new_mensaje',function(data){
    var activo =$('#msj-destino').attr('destinatario');
    if(activo==data.remitente || activo==data.destinatario){
        creatMsj(data);
    }else{
        $('#usr-'+data.remitente).addClass('nv');

    }


});


//Funcion que recibe los datos del servidor . . .

//  socket.on('messages', function(data) {
//     console.log(data);
//     render(data);
// });
// socket.on('new_mensaje',function(data){
//     alert(data);
// });




 socket.emit('setIdentidad',codigo_usuario);



function creatMsj(data){
    var remitente=data.remitente;
    if(remitente == codigo_usuario){
        var str1='<div class="row justify-content-start align-items-center"> <img src="';
        var str2='';

        var str3='" width="40" height="40" class="rounded-circle" alt="">  <div class="col-md-5"> <div class="row"> <div class="divMsj witheMsj"><p class="p">';
        var str4=data.msj;
        var str5='</p> </div></div></div></div>';

        var tot=str1+str2+str3+str4+str5;

        $("#targetChat").append(tot);
        $("#block-msj").scrollTop(10000);
    }else{
        var str1='<div class="row justify-content-end"> <div class="col-md-5"> <div class="row justify-content-end"> <div class="divMsj blueMsj">';
        var str2=data.msj;
        var str3='</p></div></div></div><img src="';
        var str4='';
        var str5='" width="40" height="40" class="rounded-circle" alt=""> </div>';

        var tot=str1+str2+str3+str4+str5;

        $("#targetChat").append(tot);
        $("#block-msj").scrollTop(10000);
    }

}
