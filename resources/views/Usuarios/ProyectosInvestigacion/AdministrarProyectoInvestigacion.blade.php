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
    <li class="breadcrumb-item"><a href="{{route('misproyectos.investigacion')}}">Mis proyectos</a></li>
    <li class="breadcrumb-item">Administrar</li>
@endsection

@section('default')

    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Administrar Proyecto</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col col-12">
                @include('Common.FlashMsj')
            </div>
        </div>
        <div class="row cuerpo-seccion">


            <div id="bvt" style="min-height: 500px!important;width: 100%!important;">
                <ul class="ui-nav"  >
                    <li>
                        <a href="#tabs-1" style="font-weight: bold">
                            <i class="fas fa-paperclip"></i>&nbsp;&nbsp;Datos generales
                        </a>
                    </li>
                    <li>
                        <a href="#tabs-2" style="font-weight: bold">
                            <i class="fas fa-search"></i>&nbsp;&nbsp;Detalles del proyecto
                        </a>
                    </li>
                    <li>
                        <a href="#tabs-3" style="font-weight: bold">
                            <i class="fas fa-book"></i>&nbsp;&nbsp;Participantes
                        </a>
                    </li>
                </ul>
                <div id="tabs-1">
                    {{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
                    @include('Frg.vista_proyecto')
                </div>
                <div id="tabs-2">{{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
                    @include('Frg.vista_detalle')
                </div>
                <div id="tabs-3">
                    <ul class="list-group" style="border-radius: 0px !important; min-width: 400px">
                        @foreach($participantes as $usuario)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col col-1" style="width: 100px">
                                        <img src="{{asset('avatar/'.$usuario->rt_foto_usuario)}}"
                                             alt="vista no disponible"
                                             class="img-thumbnail"
                                             width="100px"
                                        >
                                    </div>
                                    <div class="col col-6">

                                        <strong>
                                            <a href="#">{{$usuario->email}}</a>
                                        </strong>
                                    </div>
                                    <div class="col col-2">

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="pie-seccion">
            <div class="row justify-content-end">
                @if($proyecto->fk_id_titular == $user->pk_id_usuario)
                    <button class="btn bttn bttn-red btn-lg sw_dg_fr"  form="sw_dg_fr" onclick="this.form.submit()">Actualizar</button>
                    &nbsp;
                    <button class="btn bttn bttn-red btn-lg sw_dp_fr"  form="sw_dp_fr" onclick="this.form.submit()">Actualizar detalle</button>

                @endif
                    <div class="col-1">

                </div>
            </div>
        </div>

    </div>
    <br>
@endsection

@section('js')
    <script  src="{{asset('js/ProyectoInvestigacion/Administrar.js')}}"></script>
@endsection
