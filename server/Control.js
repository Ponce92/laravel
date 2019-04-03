var conn=require('./conexion');
var mapUsuarios=new Map();

exports.agregar=function(codigo,socket_id, callback){   
    mapUsuarios.set(codigo,socket_id);
    console.log(mapUsuarios);
}

exports.getConected=function(codigo){
    if(mapUsuarios.has(codigo)){
        return mapUsuarios.get(codigo);
    }else{
        return false;
    }
}

exports.nuevo_mensaje=function(remitente,destino,mensaje) {
    conn.putMensaje(remitente,destino,mensaje);
}

