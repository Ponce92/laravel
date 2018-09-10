@extends('Common.adminLayout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item">Invetigadores</li>
    <li class="breadcrumb-item active">Registros</li>
@endsection

@section('default')

    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <h2 class="title" style="font-weight: bold">Solicitudes de registro</h2>
                    </div>
                    <div class="col-3">
                        <form name="frm-tip" id="frm-tip" method="get" >
                            <div class="input-group">
                                <select class="custom-select custom-select-lg"
                                        id="opcion"
                                        name="opcion"
                                        onchange="this.form.submit()"
                                        style="font-weight: bold"
                                >
                                    <option value="solicitudes" @if($opt== 'solicitudes') selected @endif>Solicitudes de registro</option>
                                    <option value="activacion" @if($opt== 'activacion') selected @endif>Solicitudes de activacion</option>
                                    <option value="inactivos"@if($opt== 'inactivos') selected @endif>Usuarios Inactivos</option>
                                    <option value="activos" @if($opt== 'activos') selected @endif>Usuarios Activos</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <div class="input-group mb-3">
                    <input type="text"
                           name="busqueda"
                           id="busqueda"
                           form="frm-tip"
                           value="@if(isset($bsq)){{$bsq}} @endif"
                           class="form-control"
                           url="{{route('getDataAjax')}}"
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
                @if(isset($bsq))
                    @if($count1 != 0)
                        <div class="row">
                            <table class="table">
                                <tbody>
                                @foreach($nuevos as $obj)
                                    <tr>
                                        <td class="align-middle" width="80px">
                                            <img class="avatar" src="{{asset('avatar/'.$obj->rt_foto_usuario)}}" alt="Error al cargar foto">
                                        </td>
                                        <td >
                                            <div class="row">
                                                <div class="col">
                                                    <b>{{$obj->rt_nombre_persona}}&nbsp;{{$obj->rt_apellido_persona}}</b><br>
                                                    <b></b><br>
                                                    <b>Correo :</b>{{$obj->email}}<br>
                                                </div>
                                            </div>
                                        </td>
                                        <td></td><td></td>
                                        <td class="align-middle">
                                            <i class="fas fa-eye fa-2x bttn bttn-ver"
                                               id="{{$obj->pk_id_usuario}}"
                                               onclick="irPerfil(this.id)"></i>
                                        </td>
                                        <td class="align-middle">
                                            @if($obj->rt_estado=='Activo')
                                                <i class="fas fa-toggle-on is-activo fa-2x bttn bttn-ver "

                                                ></i>
                                            @else
                                                <i class="fas fa-toggle-off fa-2x bttn bttn-ver "
                                                ></i>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <h3 style="color: #555555; font-weight: bold">No hay registros que concuerden con el nombre especificado</h3>
                        <br>
                    @endif
                @else
                    @if($count1 != 0)
                        <div class="row">
                            <table class="table">
                                <tbody>
                                @foreach($nuevos as $obj)
                                    <tr>
                                        <td class="align-middle" width="80px">
                                            <img class="avatar" src="{{asset('avatar/'.$obj->rt_foto_usuario)}}" alt="Error al cargar foto">
                                        </td>
                                        <td >
                                            <div class="row">
                                                <div class="col">
                                                    <b>{{$obj->rt_nombre_persona}}&nbsp;{{$obj->rt_apellido_persona}}</b><br>
                                                    <b></b><br>
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
                        <h3 style="color: #555555; font-weight: bold">No Hay solicitudes nuevas.</h3>
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
    <script  src="{{asset('js/GestionInvestigadores.js')}}"></script>
@endsection

