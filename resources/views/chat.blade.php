@extends('Common.adminLayout')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
@include('AdminFragment.FrgMenIzq')
@endsection
@section('default')
<html lang="es">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<head>
    <meta charset="UTF-8">
    <title>My Aplicación con Sockets</title>



</head>
<body>
<div class="center-block">
        <h1 style="text-align: center">CHAT</h1>

    <form name="chat"  onsubmit="return addMessage(this)">
        <input type="hidden" id="username" value="{{$persona->rt_nombre_persona}}"  >
        <input  type="text"  style=" margin-left:70px; width:400px" id="texto" placeholder="Cuéntanos algo..." value="">
        <input type="submit" value="Enviar!">



    </form >
    <br/>


            <div name="fopen">
            <?php
            $file = fopen($_SERVER['DOCUMENT_ROOT']."/documento.txt", "r") or exit("Unable to open file!");
            //Output a line of the file until the end is reached
            while(!feof($file))
            {
                ?>
                <div class='msj-rta macro' >  <?php echo fgets($file) ?> </div>
                <?php
                }
            fclose($file);
            ?>
        </div>
</div>
        <div id="messages"  name="messages" >

        </div>
        <br/>




</body>
</html>
@endsection

@section('js')
<script  src="{{asset('js/usuario.js')}}"></script>
<script src="http://localhost:8080/socket.io/socket.io.js"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection



