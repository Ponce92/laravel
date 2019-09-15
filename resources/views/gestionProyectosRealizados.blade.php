@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
@include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
    <li class="breadcrumb-item">Perfil</li>
    <li class="breadcrumb-item active">Proyectos realizados</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo">
        <br>
        <div class="row">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Proyectos Realizados</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <a href="{{route('agregarProyectosRealizadoForm')}}">
                        <button class="btn bttn-red">&nbsp;&nbsp; Agregar &nbsp;&nbsp;</button>
                    </a>

                </div>

            </div>
            <hr style="margin-bottom: 2px;margin-top: 0px;">
        </div>
        <br>
        @include('Common.FlashMsj')
            <br>
        @if($errors->any())
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger">
                        <i class="fas fa-info-circle" style="color: #aa0000"></i>
                        {{$errors->first()}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif


            @if(isset($proyectos))
                <table class="table table-bordered">
                    <thead hidden>
                        <tr>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td><td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyectos as $proyecto )

                        <tr>
                            <td rowspan="3" colspan="3" class="align-middle" align="center">
                                <i class="icon-rocket fa-4x" style="color: #3e4548;"></i>
                            </td>
                            <td class="td" colspan="1">Título del Proyecto</td>
                            <td colspan="3">{{$proyecto->rt_titulo_proyecto}}</td>
                            <td class="td" colspan="1">Área de conocimiento:</td>
                            <td colspan="2">
                                    {{$proyecto['area']}}
                            </td>

                            <td colspan="1" rowspan="3" align="center" class="align-middle tdbtn">
                                <a href="{{route('gestionProyectosRealizados')}}/editar/{{$proyecto->pk_id_proyecto}}">
                                    <i class="fas fa-eye fa-2x bttn bttn-ver"
                                       id="{{$proyecto->pk_id_proyecto}}"
                                       onclick="verProyecto(this)"></i>
                                </a>

                            </td>

                            <td colspan="1" rowspan="3" align="center" class="align-middle tdbtn">
                                <i class="fas fa-trash-alt fa-2x bttn bttn-del"
                                   id="{{$proyecto->pk_id_proyecto}}"
                                   onclick="eliminarProyecto(this)"
                                ></i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1" class="td">Fech. Inicio :</td>
                            <td colspan="">{{$proyecto->rf_fecha_inicio_proyecto}}</td>

                            <td colspan="1" class="td">Fech. finalización :</td>
                            <td colspan="1">{{$proyecto->rf_fecha_fin_proyecto}}</td>

                            <td colspan="1" class="td">País de ejecución:</td>
                            <td colspan="2">
                                @foreach($paises as $pais)
                                    {{ $pais->pk_id_pais == $proyecto->fk_id_pais ? $pais->rt_nombre_pais:''  }}
                                @endforeach
                            </td>

                        </tr>
                        <tr>
                            <td colspan="1" class="td"> Descripción:</td>
                            <td colspan="5">{{$proyecto->rd_descripcion_proyecto}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                @include('AdminFragment.frg_default')
            @endif

        <hr>
        <br>
        <br>
    </div>


{{-- ..............Formulario de eliminación de proyectos .................. --}}

    <div class="row" hidden="hidden">
        <div class="col">
            <form id="delete" action="{{route('eliminarProyectosRealizado')}}" method="post">
                {{ csrf_field()  }}
                <input id="idd" name="idd" type="text">
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
                            Está a punto de eliminar este proyecto, si lo hace no podrá recuperarlo.
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script  src="{{asset('js/ProyectosRealizados.js')}}"></script>
@endsection
