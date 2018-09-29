@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Proyectos de investigacion</li>
    <li class="breadcrumb-item active">Mis proyectos</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Mis proyectos de investigacion</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <a href="{{route('registrar.proyectos.investigacion.form')}}">
                        <button class="btn btn-lg bttn-red">&nbsp;&nbsp; Nuevo registro &nbsp;&nbsp;</button>
                    </a>
                </div>
            </div>

        </div>
        <hr>
        <br>
        <div class="row cuerpo-seccion">
            <div class="container-fluid">
                @include('Common.FlashMsj')
                <div class="row">
                    @if(count($prjs)!=0)
                        @foreach($prjs as $prj)
                            <div class="card mb-3" style="width: 18rem;margin-left: 15px">
                                <div class="card-header">
                                    <div class="row justify-content-center">

                                        <i class="{{$prj['icono']}} fa-3x {{$prj->rt_color}}"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="cb-tit-prj">
                                        {{$prj->rt_titulo_proyecto}}
                                    </h4>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-end">
                                        <a href="{{route('misproyectos.investigacion')}}/{{$prj->pk_id_proyecto_investigacion}}">
                                            <button class="btn btn-success btn-lg">
                                                Administrar
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <br><br><br><br>
                        <div class="col-10 offset-1">
                            <h1 style="color: rgb(100,100,100);font-weight: bold;font-family: 'Open Sans'">
                                "No hemos encontrado proyectos en los que participes"
                            </h1>
                        </div>

                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
@endsection

@section('js')

@endsection



