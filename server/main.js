var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
const fs=require('file-system');


var ctrl=require('./Control');



var messages = [{
    id: "1",
    text: "Probando",
    author: "Stanley"
}];

app.use(express.static('public'));



server.listen(8080, function() {
    console.log("Servidor corriendo en http://localhost:8080");
});


io.on('connection', function(socket) {
    console.log('Alguien se ha conectado con Sockets');
        // ========================================== Se establece la identidad del usuario =======================

        socket.on('setIdentidad',function(data){
            ctrl.agregar(data,socket.id);
            
        });

        //===================================== Recepccion de mensajes =============================================
        socket.on('mensaje',function(data){
            console.log(data);
            ctrl.nuevo_mensaje(data.destinatario,data.remitente,data.msj);
            io.to(socket.id).emit('new_mensaje', data);
            
            var socket_id=ctrl.getConected(data.destinatario);
            if(socket_id){
                io.to(socket_id).emit('new_mensaje', data);
            }
        });
});
