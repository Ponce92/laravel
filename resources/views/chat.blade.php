@extends('Common.adminLayout')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
@include('AdminFragment.FrgMenIzq')
@endsection
@section('default')
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>My Aplicación con Sockets</title>

    <script src="/node_modules/socket.io/lib/socket.io.js" type="text/javascript"></script>
    <script src="../../public/main.js" type="text/javascript"></script>

</head>
<body>
<h1>Chat RIUES</h1>
<div id="messages"></div>
<br/>
<form onsubmit="return addMessage(this)">
    <input type="text" id="username" value="{{$persona->rt_nombre_persona}}"  >
    <input type="text" id="texto" placeholder="Cuéntanos algo...">
    <input type="submit" value="Enviar!">
</form>
</body>
</html>
@endsection



@section('js')
<script  src="{{asset('js/usuario.js')}}"></script>
@endsection



