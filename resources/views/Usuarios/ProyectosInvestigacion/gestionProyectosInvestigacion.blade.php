@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
    <li class="breadcrumb-item active">Proyectos de investigación</li>
    <li class="breadcrumb-item active">Mis proyectos</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Mis proyectos de investigación</h2>
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
    
                    @if(count($prjs) > 0)
                        @foreach($prjs as $prj)
                            <div class="card mb-3" style="width: 15rem;margin-left: 15px;">
                                <div class="card-header">
                                    <div class="row justify-content-center">

                                        <i class="{{$prj['icono']}} fa-3x {{$prj['color']}}"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                     <label for="#">Titulo  </label>
                                    <br class="text-h4-card">
                                        {{ substr($prj->rt_titulo_proyecto, 0, 100) }}...
                                    </br>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-center">
                                        <a href="{{route('proyecto.gestion.documentos')}}/{{$prj->pk_id_proyecto_investigacion}}">
                                            <button class="btn bttn-red" style="color: #fff; font-size: 14px!important;">
                                                Documentos
                                            </button>
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="{{route('misproyectos.investigacion')}}/{{$prj->pk_id_proyecto_investigacion}}">
                                            <button class="btn bttn btn-success" style="color: #fff; font-size: 14px!important;">
                                                Administrar
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else

                        @include('AdminFragment.frg_default')

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
