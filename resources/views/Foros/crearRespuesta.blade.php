@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">


@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')

    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/foros/show/{{$tema->fk_id_foro}}">Temáticas</a></li>
    <li class="breadcrumb-item active"> Agregar Respuestas</li>


@endsection

@section('default')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h3 class="titulo-seccion titulo" >Agrega tu Respuesta</h3>
                <h4>Tematica: {{$tema->titulo}}</h4>
            </div>
        </div>
        <hr>
        <br>
        @include('Common.FlashMsj')
        <div class="container">
            <form method="POST" action="/respuestas" enctype="multipart/form-data">
                {{ csrf_field()  }}
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="idt" value="{{$idt}}">
                            <div class="form-row">

                                <textarea name="desc" id="desc" cols="30" rows="4" class="form-control {{$errors->has('desc') ? 'is-invalid':''}}" required=""></textarea>

                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="boton-rojo-riues">Agregar</button>
                            <button type="button" onclick="location.href = '/foros/show/{{$tema->fk_id_foro}}'"  class="boton-rojo-riues"><i class="fa fa-trash-o"></i> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

@endsection


@section('js')
@endsection