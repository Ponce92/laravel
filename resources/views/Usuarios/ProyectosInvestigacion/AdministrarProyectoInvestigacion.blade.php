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
        <div class="row cuerpo-seccion">
            <div id="bvt" style="min-height: 800px!important;width: 100%!important;">
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
                            <i class="fas fa-book"></i>&nbsp;&nbsp;Documentos
                        </a>
                    </li>
                    <li>
                        <a href="#tabs-4"style="font-weight: bold">
                            <i class="fas fa-users"></i>&nbsp;&nbsp; Colaboradores
                        </a>
                    </li>
                </ul>
                <div id="tabs-1">
                    {{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
                
                </div>
                <div id="tabs-2">{{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
                </div>
                <div id="tabs-3">{{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
                </div>
                <div id="tabs-4"></div>{{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
            </div>
            <br>
        </div>
        <br><br><br>
    </div>
    <br>
@endsection

@section('js')
    <script>
        $( function() {
            $( "#bvt" ).tabs({
                heightStyle:"fill",
                classes:{
                    "ui-tabs-tab":"ui-tabs-tab-ctm",
                    "ui-tabs-nav":"ui-nav",

                }

            });

        } );
    </script>
@endsection



