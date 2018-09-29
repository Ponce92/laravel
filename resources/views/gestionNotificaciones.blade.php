@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo">Notificaciones</h2>
            </div>
        </div>
        <hr style="margin-top: 0px;">
        <br>
        <div class="row cuerpo-seccion">
            <div class="container-fluid">
                @if(count($notif) != 0)
                    rrrrrrrrrrrrrr
                @else
                    <br><br>
                    <div class="row justify-content-center">
                        <h3 style="font-weight: bold;font-size: 30px;color: gray">
                            "No tienes notificaciones nuevas"
                        </h3>
                    </div>
                @endif
            </div>

        </div>
        <br><br>
    </div>
    <br>
    <br>
@endsection

@section('js')

@endsection



