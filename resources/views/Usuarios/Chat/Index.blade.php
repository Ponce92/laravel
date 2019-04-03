@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/chat.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}"> --}}
@endsection


@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/foros">Chat</a></li>
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="col-md-12" id="block-msj">
        <div class="targetChat" id="targetChat">
            {{-- @include('Usuarios.Chat.frgChat') --}}
        </div>
    </div>

<div class="col-md-12 sendMsj " id="sendMsj" codigo-user="{{$user->getId()}}" >
        <div class="row align-items-center">
            <div class="col-sm-9 col-md-11 ">
                <input type="text" class="form-control" id="chtInput" name="" value="">
            </div>
            <div class=" col-sm-3 col-md-1">
                <div class="row justify-content-center">
                    <i  class="fas fa-angle-double-right fa-2x rounded-circle" id="sendBtn" onclick="sendMensaje()"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="http://localhost:8080/socket.io/socket.io.js"></script>
    <script src="{{asset('js/Chat/Chat.js')}}" ></script>
@endsection
