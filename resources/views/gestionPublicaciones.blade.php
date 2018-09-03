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
                <h2 class="titulo-seccion">Publicaciones</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <button id="btn-agregar"
                            class="boton-rojo-riues"
                            onclick="verFormAgregar()">&nbsp;&nbsp;
                        Agregar &nbsp;&nbsp;
                    </button>
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
            @if(isset($publicaciones))
                @foreach($publicaciones as $publicacion )
                    <tr>
                        <td class="align-middle">
                            <i class="fab fa-codepen fa-4x "></i>
                        </td>

                        <td>
                            <div class="row">
                                <div class="col">

                                    <b>
                                        Titulo :  <i>{{$publicacion->rt_titulo_publicacion}} </i>
                                    </b>
                                    <br>
                                    <b>Area Conocimiento :</b>
                                    @foreach($areas as $area)
                                        @if($area->pk_id_area == $publicacion->fk_id_area)
                                            {{$area->rt_nombre_area}}
                                        @endif
                                    @endforeach
                                    <br>
                                    <b>Tipo de publicacion : </b>{{$publicacion->rt_tipo_publicacion}}<br>
                                    <b>Fecha publicacion : </b>{{$publicacion->rf_fecha_publicacion}}<br>
                                    <b>Descripcion:</b>  {{$publicacion->rd_descripcion_publicacion}}<br>
                                    <b>Url:</b><a href="{{$publicacion->rt_enlace_publicacion}}">{{$publicacion->rt_enlace_publicacion}}</a>

                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-eye fa-2x bttn bttn-ver"
                               name="{{route('getPublicacionAjax')}}"
                               id="{{$publicacion->pk_id_publicacion}}"
                               onclick="verPublicacion(this)"></i>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-trash-alt fa-2x bttn bttn-del"
                               id="{{$publicacion->pk_id_publicacion}}"
                               onclick="eliminarPublicacion(this)"
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

    @if(isset($publicaciones))
    @else
        <br>
        <br>
        <br>
        <div class="row align-items-center">

            <div class="col-8 offset-2 align-content-center">
                <h1 style="font-size: 2.5em; font-family: Aller;color: rgb(130,130,130);">
                    " No tienes publicaciones registradas "
                </h1>
            </div>
        </div>
    @endif

{{-- ........................Formulario de crear Publicacion ................................................ --}}
{{-- ...............................                      ... .................................................. --}}
{{-- ..........................................   .............................................................. --}}

<div id="agregar-frm"  title="Agregar Publicacion">
    <form id="frmA" method="post"  action="{{route('agregarPublicacion')}}">
        {{ csrf_field()  }}
        <div class="row">
            <div class="col" id="div-err-agregar">

            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombreProyecto">Titulo de Publicacion :</label>
                    <input type="text"
                           autocomplete="off"
                           class="form-control mb-3"
                           name="titulo"
                           id="titulo"
                    >
                    <div class="invalid-feedback">
                        Un titulo valido de llevar mas de 6 letras y menos de 100.
                    </div>
                </div>
            </div>
        </div>

        <div class="row">{{--   Area y tipo de publicacion    --}}
            <div class="col">
                <label for="tipo">Tipo de publicacion :</label>
                <select name="tipo" class="form-control mb-3" id="tipo">
                    <option value="Articulo Cientifico">Articulo Cientifico</option>
                    <option value="Nota Cientifica">Nota cientifica</option>
                    <option value="Libro">Libro</option>
                </select>
            </div>

            <div class="col">
                <label for="area">Area Conocimiento :</label>
                <select name="area" id="area" class="form-control  mb-3">
                    @foreach($areas as $area)
                        <option value="{{$area->pk_id_area}}">{{$area->rt_nombre_area}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="fechaIncicio">Fecha Publicacion :</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                    </div>
                    <input type="link"
                           autocomplete="off"
                           class="form-control"
                           name="fecha"
                           id="fecha"
                           readonly
                    >
                    <div class="invalid-feedback">
                        Debe proporcionar una fecha valida.
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <label for="descripcion">Descripcion:</label>
                <textarea   class="form-control  mb-3"
                            rows="3"
                            autocomplete="off"
                            cols="60"
                            placeholder="Descripcion..."
                            name="descripcion"
                            id="descripcion"
                ></textarea>
                <div class="invalid-feedback">
                    Una descripcion valida posee mas de 10 caracteres y menos de 150.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="enlace"> Enlace de la Publicacion</label>
                    <input type="text"
                           class="form-control mb-3"
                           id="enlace"
                           name="enlace"
                           autocomplete="off"
                    >
                    <div class="invalid-feedback">
                        Un enlace valido tiene la forma: http://google.com
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

{{-- ........................Formulario de edicion de Proyectos ................................................ --}}
{{-- ...............................                      ... .................................................. --}}
{{-- ..........................................   .............................................................. --}}

<div id="editar-frm" title="Detalle Publicacion">
        <form class="agergarProyecto" method="post" action="{{route('actualizarPublicacion')}}">
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
                        <i class="fas fa-toggle-off fa-2x inactivo" id="switch-edit"></i>
                    </div>

                </div>
            </div>

            <div class="row">
                <input id="id_pu" name="id_pu" type="text" hidden>
                <div class="col " id="div-error-edit">

                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="nombreProyecto">Titulo Publicacion :</label>
                        <input type="text"
                               autocomplete="off"
                               id="titulo-edt"
                               class="form-control mb-3 edt"
                               name="titulo-edt"
                               disabled
                        >
                        <div class="invalid-feedback">
                            Un titulo valido contiene mas de 6 caracteres y menos de 100.
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="tipo-edt">Tipo publicacion :</label>
                    <select name="tipo-edt" id="tipo-edt" class="form-control mb-3 edt" disabled>
                        <option value="Articulo Cientifico">Articulo Cientifico</option>
                        <option value="Nota Cientifica">Nota cientifica</option>
                        <option value="Libro">Libro</option>
                    </select>
                </div>
                <div class="col">
                    <label for="descripcion">Area Conocimiento :</label>
                    <select name="area-edt" id="area-edt" class="form-control mb-3 edt" disabled>
                        @foreach($areas as $area)
                            <option value="{{$area->pk_id_area}}">{{$area->rt_nombre_area}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="fecha-edt">Fecha publicacion :</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text"
                               autocomplete="off"
                               name="fecha-edt"
                               id="fecha-edt"
                               class="form-control edt"
                               disabled
                               readonly
                        >
                        <div class="invalid-feedback">
                            Ingresa una fecha valida.
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="descripcion">Descripcion :</label>
                    <textarea class="form-control mb-3 edt"
                              name="descripcion-edt"
                              id="descripcion-edt"
                              disabled="true"
                              rows="4"
                              cols="60"
                              placeholder="Descripcion..."
                    ></textarea>
                    <div class="invalid-feedback">
                        Una descripcion valida contiene mas de 6 caracteres y menos de 150.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="enlace-edt">Link de publicacion</label>
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                        <input type="text"
                               name="enlace-edt"
                               id="enlace-edt"
                               class="form-control edt"
                               disabled
                        >
                        <div class="invalid-feedback">
                            Proporciona url valida. Ejemplo: http://google.com
                        </div>
                    </div>
                </div>
            </div>
        </form>
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