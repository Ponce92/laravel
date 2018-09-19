@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Perfil</li>
    <li class="breadcrumb-item active">Publicaciones</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo">
        <br>
        <div class="row">
            <div class="col-8">
                <h2 class="titulo-seccion titulo"> Mis Publicaciones</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <a href="{{route('agregarPublicacionForm')}}">
                        <button id="btn-agregar"
                                class="boton-rojo-riues"
                        >&nbsp;&nbsp;Agregar &nbsp;&nbsp;
                        </button>

                    </a>
                </div>

            </div>
        </div>
        <hr>
        <br>
        @include('Common.FlashMsj')
            <table class="table table-bordered">
                <thead hidden>
                    <tr>
                        <td></td><td></td>
                        <td></td><td></td>
                        <td></td><td></td>
                        <td></td><td></td>
                        <td></td><td></td>
                        <td></td><td></td>
                    </tr>
                </thead>
                <tr>
                    <td colspan="12" style="background-color: #aa0000">
                        <div class="row">
                            <div class="col-11" style="color: white;font-size: 16px;font-weight: bold">
                                Notas Cientificas y Articulos cientificos
                            </div>
                            <div class="col-1" style="color: white;font-weight: bold">
                                <div class="row justify-content-end">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <div id="obj1">
                    @foreach($publicaciones as $publicacion)
                        <tr>
                            <td colspan="1" rowspan="3" class="align-middle" align="center" style="width: 150px">
                                <i class="fab fa-codepen fa-4x "></i>
                            </td>

                            <td class="td" colspan="1">Titulo Publicacion:</td>
                            <td colspan="3">
                                {{$publicacion->rt_titulo}}
                            </td>
                            <td class="td" colspan="1">Enlace :</td>
                            <td colspan="4">
                                {{$publicacion->rt_enlace_publicacion }}
                            </td>

                            <td colspan="1" rowspan="3"class="align-middle" align="center">
                                <a href="{{route('verPublicaciones')}}/editar/{{$publicacion->pk_id_publicacion}}">
                                    <i class="fas fa-edit fa-2x bttn bttn-ver">
                                   </i>
                                </a>
                            </td>
                            <td colspan="1" rowspan="3" class="align-middle" align="center">
                                <i class="fas fa-trash-alt fa-2x bttn bttn-del"
                                   id="{{$publicacion->pk_id_publicacion}}"
                                   onclick="eliminarPublicacion(this)"
                                ></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="td" colspan="1">Tipo Publicacion : </td>
                            <td colspan="2">
                                {{$publicacion->rt_tipo_publicacion =='ac' ? 'Articulo Cientifico':'Nota Cientifica'}}
                            </td>
                            <td class="td" colspan="1"> Area conocimiento:</td>
                            <td colspan="2">
                                @if(!$publicacion->rl_tipo_area)
                                    @foreach($areas as $area)
                                            {{$area->pk_id_area==$publicacion->rn_id_area ? $area->rt_nombre_area:''}}
                                    @endforeach
                                @else
                                    @foreach($otrasAreas as $area)
                                        {{$area->pk_id_ac==$publicacion->rn_id_area ? $area->rt_nombre_ac:''}}
                                    @endforeach
                                @endif
                            </td>

                            <td class="td" colspan="1"> Fecha Publicacion : </td>
                            <td colspan="1">
                                    {{$publicacion->rf_fecha_publicacion}}
                            </td>
                            <td colspan="1" class="align-middle" align="center">
                                @if(Session::has('pubb'))
                                    @if(Session::get('pubb')->pk_id_publicacion == $publicacion->pk_id_publicacion)
                                        <i class="fas fa-circle fa-2x" style="color: #00cc00"></i>
                                        {{Session::forget('pubb')}}
                                    @endif
                                @endif
                            </td>

                        </tr>
                        <tr>
                        <td class="td" colspan="1">
                            Descripcion:
                        </td>
                        <td colspan="8">
                            {{$publicacion->rd_descripcion_publicacion}}
                        </td>
                    </tr>
                @endforeach
                </div>
            </table>
            <table class="table table-bordered">
                <tr hidden>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="align-middle"
                        align="center"
                        colspan="12"
                        style="background-color: #aa0000;color:white;font-weight: bold;font-size: 16px;"
                    >
                        Publicaciones en libros
                    </td>
                </tr>
                @foreach($libros as $libro)
                    <tr>
                        <td colspan="1" rowspan="3" class="align-middle" align="center" style="width: 150px">
                            <i class="fab fa-codepen fa-4x "></i>
                        </td>

                        <td class="td" colspan="1">Titulo libro:</td>
                        <td colspan="4">
                            {{$libro->rt_titulo}}
                        </td>
                        <td class="td" colspan="1">Fecha publicacion :</td>
                        <td colspan="1">
                            {{$publicacion->rf_fecha_publicacion}}
                        </td>
                        <td colspan="1" class="td" style="width: 75px">ISSN :</td>
                        <td colspan="1" >{{$libro->rt_issn}}</td>
                        <td colspan="1" rowspan="3"class="align-middle" align="center">
                            <a href="{{route('verPublicaciones')}}/editar/libro/{{$libro->pk_id_libro}}">
                                <i class="fas fa-edit fa-2x bttn bttn-ver">
                                </i>
                            </a>
                        </td>
                        <td colspan="1" rowspan="3" class="align-middle" align="center">
                            <i class="fas fa-trash-alt fa-2x bttn bttn-del"
                               id="{{$libro->pk_id_libro}}"
                               onclick="eliminarLibroP(this)"
                            ></i>
                        </td>
                    </tr>
                    <tr>
                        <td class="td" colspan="1">Area conocimiento:</td>
                        <td colspan="3">
                            @if(!$libro->rl_tipo_area)
                                @foreach($areas as $area)
                                    {{$area->pk_id_area==$libro->rn_id_area ? $area->rt_nombre_area:''}}
                                @endforeach
                            @else
                                @foreach($otrasAreas as $area)
                                    {{$area->pk_id_ac==$libro->rn_id_area ? $area->rt_nombre_ac:''}}
                                @endforeach
                            @endif
                        </td>
                        <td colspan="1" class="td" >Capitulo : </td>
                        <td colspan="1">{{$libro->rn_capitulo}}</td>

                        <td colspan="1" class="td" style="width: 125px">Pagina:</td>
                        <td colspan="1">{{$libro->rn_pagina}}</td>

                        <td colspan="1" class="align-middle" align="center">
                            @if(Session::has('libb'))
                                @if(Session::get('libb')->pk_id_libro==$libro->pk_id_libro)
                                    <i class="fas fa-circle fa-2x" style="color: #00cc00"></i>
                                    {{Session::forget('libb')}}
                                @endif

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="td" colspan="1">
                            Descripcion:
                        </td>
                        <td colspan="8">
                            {{$libro->rd_descripcion}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <hr>
        <br>
        <br>
    </div>

{{-- ..............Formulario de eliminacion de proyectos .................. --}}

    <div class="row" hidden="hidden">
        <div class="col">
            <form id="delete" action="{{route('eliminarPublicacion')}}" method="post">
                {{ csrf_field()  }}
                <input id="id_obj" name="id_obj" type="text">
            </form>
        </div>

        <div class="col">
            <form id="deleteL" action="{{route('eliminarLibroPublicado')}}" method="post">
                {{ csrf_field()  }}
                <input id="id_lp" name="id_lp" type="text">
            </form>
        </div>


        <div class="col">
            <div class="row" id="conf" title="Atencion">
                <div class="col-4">
                    <i class="fas fa-exclamation-circle fa-3x" style="color: #aa0000"></i>
                </div>
                <div class="col-8">
                    <p>
                        <b>
                            Estas a punto de eliminar esta publicacion, si lo haces no podras recuperarla.
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script  src="{{asset('js/Publicaciones.js')}}"></script>
@endsection