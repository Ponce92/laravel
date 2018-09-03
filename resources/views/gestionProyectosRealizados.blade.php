@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
@include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="container-fluid area-trabajo">
        <br>
        <div class="row">
            <div class="col-8">
                <h2 class="titulo-seccion">Proyectos Realizados</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <button id="btn-agregar" class="boton-rojo-riues" onclick="verDialogFrm()">&nbsp;&nbsp; Agregar &nbsp;&nbsp;</button>
                </div>

            </div>
            <hr style="margin-bottom: 2px;margin-top: 0px;">
        </div>
        <br>
        @if(isset($status))
            <div class="row">
                <div class="col">
                    <div class="alert alert-success">
                        <i class="fas fa-info-circle" style="color: green"></i>
                        {{$status}}
                    </div>
                </div>
            </div>
            @else

            <br>
        @endif
        @if($errors->any())
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger">
                        <i class="fas fa-info-circle" style="color: #aa0000"></i>
                        {{$errors->first()}}
                    </div>
                </div>
            </div>
        @endif

            <table class="table">
                <tbody>
                    @if(isset($proyectos))
                        @foreach($proyectos as $proyecto )
                        <tr>
                            <td class="align-middle">
                                <i class="fab fa-codepen fa-4x "></i>
                            </td>

                            <td>
                                <div class="row">
                                    <div class="col">

                                        <b>
                                            Titulo :  <i>{{$proyecto->rt_titulo_proyecto}} </i>
                                        </b>
                                        <br>
                                        <b>Area Conocimiento :</b>
                                        @foreach($areas as $area)
                                            @if($area->pk_id_area == $proyecto->fk_id_area)
                                                {{$area->rt_nombre_area}}
                                            @endif
                                        @endforeach
                                        <br>
                                            <b>Desde : </b>{{$proyecto->rf_fecha_inicio_proyecto}}
                                            <b>Hasta : </b>{{$proyecto->rf_fecha_fin_proyecto}}
                                            <br>
                                            <b>Descripcion:</b>  {{$proyecto->rd_descripcion_proyecto}}

                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                        <i class="fas fa-eye fa-2x bttn bttn-ver"
                                           name="{{route('getProyectosRealizadosAjax')}}"
                                           id="{{$proyecto->pk_id_proyecto}}"
                                           onclick="verProyecto(this)"></i>
                            </td>
                            <td class="align-middle">
                                <i class="fas fa-trash-alt fa-2x bttn bttn-del"
                                   id="{{$proyecto->pk_id_proyecto}}"
                                   onclick="eliminarProyecto(this)"
                                ></i>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        <hr>
        <br>
        <br>
    </div>
    @if(isset($proyectos))
        @else
        <br>
        <br>
        <br>
        <div class="row align-items-center">

            <div class="col-8 offset-2 align-content-center">
                <h1 style="font-size: 2.5em; font-family: Aller;color: rgb(130,130,130);">
                    " No tienes proyectos registrados "
                </h1>
            </div>
        </div>
    @endif
{{-- .............Formulario de edicion de Proyectos ............................ --}}
<div id="frm-act" title="Proyecto Realizado">
    <form class="agergarProyecto" method="post" action="{{route('editarProyectosRealizado')}}" id="frm-edt">
        <input type="text"
               name="id"
               form="frm-edt"
               id="id"
               hidden="hidden"
        >
        {{ csrf_field()  }}
        <div class="row cabeza-seccion">
            <div class="col-9">
            </div>
            <div class="col-3 align-middle" style="align-content: center;display: flex;align-items: center">
                <div class="row align-items-center" >
                    <div class="col">
                        <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                    </div>
                </div>

                <div class="col">
                    <i class="fas fa-toggle-off fa-2x inactivo" id="switch-prj-edit"></i>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col " id="div-error-edit">
            </div>
        </div>
        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label for="nombreProyecto">Nombre del Proyecto :</label>
                    <input type="text"
                           form="frm-edt"
                           autocomplete="off"
                           id="nombre-edt"
                           class="form-control edt"
                           name="nombre-edt"
                           disabled
                    >
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="fechaIncicio">Fecha Incicio :</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <input type="text"
                               form="frm-edt"
                               autocomplete="off"
                               name="fechaInicio-edt"
                               class="form-control edt"
                               id="fechaInicio-edt"
                               disabled
                               readonly
                        >
                    </div>
                </div>
            </div>
            <div class="col">
                <label for="fechaFin-edt">Fecha Finalizacion:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <input type="tex"
                               form="frm-edt"
                               class="form-control edt"
                               autocomplete="off"
                               id="fechafin-edt"
                               name="fechafin-edt"
                               disabled
                               readonly
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <br>
                <label for="descripcion">Area Conocimiento :</label>
                <select name="area" id="area-edt" class="form-control" form="frm-edt" disabled>
                    <option id="01" value="" selected></option>
                </select>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="descripcion">Descripcion :</label>
                <br>
                <textarea class="edt"
                          name="txtArea-edt"
                          form="frm-edt"
                          id="textarea-edt"
                          disabled="true"
                          rows="4"
                          cols="60"
                          placeholder="Descripcion..." ></textarea>
            </div>
        </div>
    </form>
</div>
 {{-- ..............Definicion de formularios para jqueyry ui .................. --}}

        <div id="frm-agregar"  title="Agregar Proyecto Realizado">
            <form id="frm-add" method="post"  action="{{route('agregarProyectosRealizado')}}">
                {{ csrf_field()  }}
                <div class="row">
                    <div class="col" id="errores"></div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nombreProyecto">Nombre del Proyecto :</label>
                            <input type="text"
                                   autocomplete="off"
                                   form="frm-add"
                                   class="form-control"
                                   name="nombreArea-crt"
                                   id="nombreArea-crt"
                            >
                            <div class="invalid-feedback">
                                Error en el nombre
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="fechaIncicio">Fecha Incicio :</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text"
                                   form="frm-add"
                                   autocomplete="off"
                                   class="form-control"
                                   name="fechaInicio"
                                   id="fechaInicio"
                                   readonly
                            >
                            <div class="invalid-feedback">
                                El campo fecha es incorrecto.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="fechaFin">Fecha Finalizacion:</label>
                        <div class="input-group  mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text"
                                   autocomplete="off"
                                   form="frm-add"
                                   class="form-control"
                                   id="fechaFin"
                                   readonly
                                   name="fechaFin"
                            >
                            <div class="invalid-feedback">
                                El campo fecha es incorrecto.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="area">Area Conocimiento</label>
                        <select name="area" id="area" class="form-control  mb-3" form="frm-add">
                            @foreach($areas as $area)
                                <option value="{{$area->pk_id_area}}">{{$area->rt_nombre_area}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <label for="descripcion">Descripcion:</label>
                        <textarea   class="form-control  mb-3"
                                    rows="4"
                                    form="frm-add"
                                    autocomplete="off"
                                    cols="60"
                                    placeholder="Descripcion..."
                                    name="descripcion"
                                    id="descripcion"
                        ></textarea>
                        <div class="invalid-feedback">
                        Este campo es bligatorio.
                        </div>
                    </div>
                </div>
            </form>
        </div>

{{-- ..............Formulario de eliminacion de proyectos .................. --}}

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
                            Estas a punto de eliminar este proyecto, si lo haces no podras recuperarlo.
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