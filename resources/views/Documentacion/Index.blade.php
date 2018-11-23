@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item ">Proyectos de investigacion</li>
    <li class="breadcrumb-item ">Documentos</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo">Documentos de proyecto</h2>
            </div>
        </div>
        <hr class="all" style="margin-top: 0px;">
        <div class="cuerpo-seccion">
            <br>
            <table>

            </table>
        </div>

    </div>

@endsection

@section('js')

@endsection