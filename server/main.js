var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);

const fs=require('file-system');



var messages = [{
    id: "1",
    text: "Probando",
    author: "Stanley"
}];

app.use(express.static('public'))


io.on('connection', function(socket) {
    console.log('Alguien se ha conectado con Sockets');
    socket.emit('messages', messages);

    socket.on('new-message', function(data) {
        messages.push(data);

        io.sockets.emit('messages', messages);

        for (var prop in messages){
            console.log(messages[prop]);
        }

        for (var val = messages.length-1; val <messages.length; val++){

            fs.writeFile('public/documento.txt',"<b>"+messages[val].author +":</b> \t\t"+ messages[val].text +"\n", {'flag':'a'}, function (err) {
                if (err) throw err;
                console.log('doc creado con exito');
            });
        }


    });
});

server.listen(8080, function() {
    console.log("Servidor corriendo en http://localhost:8080");
});