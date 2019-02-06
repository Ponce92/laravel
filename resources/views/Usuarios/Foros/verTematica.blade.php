@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">
@endsection


@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/foros">Foros</a></li>
    <li class="breadcrumb-item active"></li>
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">{{$tematica->getTitulo()}} </h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <a href="{{route('tematica.respuesta.form',['id'=>$tematica->getId()])}}">
                        <button  class="btn bttn bttn-red">&nbsp;&nbsp;Agregar Respuesta&nbsp;&nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <br>
        @include('Common.FlashMsj')
        <div class="cuerpo-seccion" style="min-height: 400px;">
            <div class="row justify-content-center">
                <div class="col-sm-11">
                    <div class="card">
                        <div class="card-header" style="font-weight: bold;">{{$tematica->getTitulo()}}</div>
                        <div class="card-body">
                            {!!$tematica->getDesc()!!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-11">
                    @foreach($tematica->getRespuestas() as $res)
                        @if($res->getUser()->getId()==$user->getId())
                            <div class="row justify-content-start">
                                <div class="col-sm-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="row justify-content-center">
                                                        <img src="{{asset('/avatar/'.$res->getUser()->getFoto())}}"
                                                             alt="Nombre de la persona"
                                                             title="Nombre :"
                                                             class="rounded-circle"
                                                             width="65"
                                                             height="65"
                                                             style="border: 1px solid rgb(165,165,165);"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="row justify-content-end">
                                                        <strong>{{$res->getFecha()}} &nbsp;&nbsp;</strong>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {!! $res->getDesc() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div class="row justify-content-start">
                                                        <strong>&nbsp;&nbsp;{{$res->getFecha()}} </strong>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {!! $res->getDesc() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="row justify-content-center">
                                                        <img src="{{asset('/avatar/'.$res->getUser()->getFoto())}}"
                                                             alt="Nombre de la persona"
                                                             title="Nombre :"
                                                             class="rounded-circle"
                                                             width="65"
                                                             height="65"
                                                             style="border: 1px solid rgb(165,165,165);"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
            </div>



        </div>
        <div class="pie-seccion">

        </div>


    </div>
    <br>

@endsection

@section('js')


@endsection