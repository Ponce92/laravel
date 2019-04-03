var pg = require("pg")
var connectionString = "pg://postgres:postgres@localhost:5432/riues";
var client = new pg.Client({
    user: 'riues',
    host: 'localhost',
    database: 'riues',
    password: 'riues',
    port: 5432,
});
client.connect();

//============================================================================================

exports.putMensaje=function(remitente,destinatario,mensaje){
    const now = new Date();
    const sql='INSERT INTO app.tbl_mensajes(fk_destinatario,fk_remitente, rt_mensaje, rt_codigo,rf_fecha) VALUES ($1, $2, $3, $4,$5)';
    const values =[destinatario,remitente,mensaje,remitente + "_" + destinatario,now]
    console.log(values);
    client.query(sql,values);
}