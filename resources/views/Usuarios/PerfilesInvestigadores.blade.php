@extends('Common.adminLayout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item">Perfiles</li>
    <li class="breadcrumb-item active">Investigadores</li>
@endsection

@section('default')

    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <h2 class="title" style="font-weight: bold">Registros de investigadores</h2>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-3">
                <form name="frm-tip" id="frm-tip" method="get" >
                    <div class="input-group">
                        <select class="custom-select"
                                id="opcion"
                                name="opcion"
                                onchange="enviarSelect(this)"
                                style="font-weight: bold"
                        >
                            <option value="-1">-- Area del conocimiento --</option>
                            @foreach($areas as $area)
                                <option value="{{$area->pk_id_area}}" @if($area->pk_id_area==$opt) selected @endif>{{$area->rt_nombre_area}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-3">
                <div class="input-group mb-3">
                    <input type="text"
                           name="busqueda"
                           id="busqueda"
                           form="frm-tip"
                           value="@if(isset($bsq)){{$bsq}} @endif"
                           class="form-control"
                           url="{{route('getNombresPerfilesAjax')}}"
                    >
                    <div class="input-group-append">
                        <div class="input-group-text bttn-ver" onclick="formulario()">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                @if($count != 0)
                    <div class="row">
                        <table class="table">
                            <tbody>
                            @foreach($registros as $obj)
                                <tr>
                                    <td class="align-middle" width="80px">
                                        <img class="avatar" src="{{asset('avatar/'.$obj->rt_foto_usuario)}}" alt="Error al cargar foto">
                                    </td>
                                    <td >
                                        <div class="row">
                                            <div class="col">
                                                <b>{{$obj->rt_nombre_persona}}&nbsp;{{$obj->rt_apellido_persona}}</b><br>
                                                <b>Area Conocimiento :</b>
                                                @foreach($areas as $area)
                                                    @if($area->pk_id_area == $obj->fk_id_area)
                                                        {{$area->rt_nombre_area}}
                                                    @endif
                                                @endforeach
                                                <br>
                                                <b>Correo :</b>{{$obj->email}}<br>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td><td></td>
                                    <td class="align-middle">
                                        <i class="fas fa-eye fa-2x bttn bttn-ver"
                                           id="{{$obj->pk_id_usuario}}"
                                           onclick="irPerfil(this.id)"
                                        ></i>
                                    </td>
                                    <td class="align-middle">
                                        @if($obj->rt_estado=='Activo')
                                            <i id="{{$obj->pk_id_usuario}}"

                                               class="fas fa-toggle-on is-activo fa-2x bttn bttn-ver "
                                               onclick="irPerfil(this.id)"
                                            ></i>
                                        @else
                                            <i  id="{{$obj->pk_id_usuario}}"
                                                class="fas fa-toggle-off fa-2x bttn bttn-ver "
                                                onclick="irPerfil(this.id)" ></i>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <hr>
                    @if(isset($bsq))
                        <h3 style="color: #555555; font-weight: bold">No hay registros que conicidan con los criterios de busqueda . . .</h3>
                        <br>
                    @else
                        <h3 style="color: #555555; font-weight: bold">No existen registros de investigadores Activos o Inactivos . . .</h3>
                        <br>
                    @endif

                @endif


            </div>
        </div>
    </div>
    <br>
    <div class="row" hidden>
        <form action="{{route('verPerfilInvestigador')}}" id="irPerfil">
            <input type="text" id="verI" name="verI" >
        </form>
    </div>
@endsection

@section('js')
    <script  src="{{asset('js/PefilesInvestigadores.js')}}"></script>
@endsection

