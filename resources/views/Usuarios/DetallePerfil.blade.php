@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    @if($user->fk_id_rol==0)
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('gestionRegistrosInv')}}">Registros de investigadores</a></li>
        <li class="breadcrumb-item active">Perfil</li>
    @else
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('getPerfilesInvestigadores')}}">Perfiles de investigadores</a></li>
        <li class="breadcrumb-item active">Perfi</li>

    @endif

@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion" style="font-weight: bold">Perfil</h2>
            </div>
        </div>
        <hr>
        <br>
        <div class="row cuerpo-seccion">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" id="error">

                        </div>
                        @if(isset($status))
                            <div class="col-12" id="status">
                                <div class="alert alert-success">
                                    {{$status}}
                                </div>
                            </div>
                        @endif


                        <div class="col-3 ">{{--+++++++++++++++++++++++++++++++++++ Foto del Usuario++++++++++++++++++++++++++++++++++++ --}}
                            <div class="row">
                                <div class="col-12 div-image">
                                    <img src="{{asset('avatar/'.$perfil->rt_foto_usuario)}}"
                                         alt="vista no disponible"
                                         class="img-thumbnail"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-9">{{-- Nombre y apellido--}}
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nombre">Nombres :</label>
                                    <input type="text"
                                           id="nombres"
                                           name="nombres"
                                           form="form"
                                           class="form-control edt"
                                           value="{{$perfil->rt_nombre_persona}}"
                                           readonly
                                    >
                                </div>
                                <div class="col mb-3">
                                    <label for="apellidos">Apellidos :</label>
                                    <input type="text"
                                           form="form"
                                           name="apellidos"
                                           id="apellidos"
                                           class="form-control edt"
                                           value="{{$perfil->rt_apellido_persona}}"
                                           readonly

                                    >
                                </div>
                            </div>

                            <div class="row">{{-- Fecha y sexo del invetigador--}}
                                <div class="col">
                                    <label for="fechaNacimiento">Edad</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                               class="form-control edt"
                                               id="datepicker"
                                               name="fecha"
                                               form="form"
                                               value="{{$edad}}"
                                               readonly
                                        >
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label for="Sexo">Sexo :</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="Sexo"
                                               id="Sexo"
                                               form="form"
                                               value="option1"
                                               @if($perfil->rl_sexo_persona == 1)checked @endif
                                               readonly
                                        >
                                        <label class="form-check-label" for="inlineRadio1">Mujer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               form="form"
                                               id="sexo"
                                               value="Sexo"

                                               @if($perfil->rl_sexo_persona == 0)checked @endif
                                               readonly
                                        >
                                        <label class="form-check-label" for="inlineRadio2">Hombre</label>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <label for="telefono">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-envelope"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                               class="form-control edt"
                                               form="form"
                                               id="telefono"
                                               value="{{$perfil->email}}"
                                               name="telefono"
                                               readonly
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="nacionalidad">Nacionalidad :</label>
                                    <select id="pais"
                                            name="pais"
                                            class="form-control mb-3 edt"
                                            form="form"
                                            disabled
                                    >
                                        @foreach($paises as $pais)
                                            <option value="{{$pais->pk_id_pais}}"
                                                    @if($pais->pk_id_pais == $perfil->fk_id_pais)
                                                    selected
                                                    @endif>
                                                {{$pais->rt_nombre_pais}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">{{--Area Conocimiento,grado academico,horas dedicadas a investigacion --}}
                        <div class="col">
                            <label for="grado">Grado Academico :</label>
                            <select name="grado"
                                    id="grado"
                                    form="form"
                                    class="form-control edt"
                                    disabled
                            >
                                @foreach($grados as $grado)
                                    <option value="{{$grado->pk_id_grado}}"
                                            @if($perfil->fk_id_grado == $grado->pk_id_grado) selected @endif>
                                        {{$grado->rt_nombre_grado}}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col col-4">
                            <label for="area"> Area Conocimiento :</label>
                            <select name="area"
                                    id="area"
                                    form="form"
                                    class="form-control edt"
                                    disabled
                            >
                                @foreach($areas as $area)
                                    <option value="{{$area->pk_id_area}}" @if($area->pk_id_area == $perfil->fk_id_area) selected @endif>
                                        {{$area->rt_nombre_area}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-4">
                            <label for="horas">Horas dedicadas a investigacion :</label>
                            <input class="form-control edt"
                                   id="horas"
                                   form="form"
                                   name="horas"
                                   type="number"
                                   value="{{$perfil->rn_horas_dedicadas_investigacion}}"
                                   readonly
                            >
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="institucion">Institucion :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-university"></i>
                                    </div>
                                </div>
                                <input type="text"
                                       form="form"
                                       id="institucion"
                                       name="institucion"
                                       class="form-control edt"
                                       value="{{$perfil->rt_institucion}}"
                                       readonly
                                >
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="direccion">Direccion :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <input  type="text"
                                        name="direccion"
                                        form="form"
                                        id="direccion"
                                        class="form-control edt"
                                        value="{{$perfil->rt_direccion}}"
                                        readonly
                                >
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <br>
        <h2 style="font-weight: bold;color: rgb(90,90,90)">Otros</h2>
        <hr>
        <div class="row cuerpo-seccion">
            <ul id="tabs">
                <li><a href="#" name="#tab1">Proyectos Realizados ({{$count1}})</a></li>
                <li><a href="#" name="#tab2">Publicaciones ({{$count2}})</a></li>
            </ul>
            <div id="content">
                <div id="tab1" class="container-fluid">
                    <div class="row">
                        @if($count1 > 0)
                            <div class="col-12">
                                <table class="table">
                                    <tbody>
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
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        @else
                            <div class="col-12">
                                <h3 style="font-weight: bold;color: rgb(80,80,80)">Este usuario no tiene proyectos realizados . . .</h3>
                            </div>

                        @endif
                    </div>
                </div>
                <div id="tab2">
                    <table class="table">
                        <tbody>
                        @if($count2 >0)
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
                                </tr>
                            @endforeach

                        @else
                            <div class="col-12">
                                <h3 style="font-weight: bold;color: rgb(80,80,80)">
                                    Este usuario no tiene publicaciones . . .
                                </h3>
                            </div>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
    <br>

    <div class="row" hidden>
        <div id="frm-proj" title="Proyecto Realizado">
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="nombreProyecto">Titulo del Proyecto :</label>
                            <input type="text"
                                   form="frm-edt"
                                   id="nombre"
                                   class="form-control"
                                   name="nombre-edt"
                                   readonly
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
                                       name="fechaInicio"
                                       class="form-control edt"
                                       id="fechaInicio"
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
                                       class="form-control"
                                       id="fechafin"
                                       name="fechafin-edt"
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
                        <select name="area"
                                id="area-e"
                                class="form-control"
                                disabled
                        >
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
                                  id="textarea"
                                  rows="4"
                                  cols="58"
                                  readonly
                        ></textarea>
                    </div>
                </div>
        </div>
    </div>
    <div class="row" hidden>
        <div id="editar-frm" title="Detalle Publicacion">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nombreProyecto">Titulo Publicacion :</label>
                            <input type="text"
                                   id="titulo-edt"
                                   class="form-control mb-3"
                                   name="titulo-edt"
                                    readonly
                            >
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="tipo-edt">Tipo publicacion :</label>
                        <select name="tipo-edt" id="tipo-edt" class="form-control mb-3" disabled>
                            <option value="Articulo Cientifico">Articulo Cientifico</option>
                            <option value="Nota Cientifica">Nota cientifica</option>
                            <option value="Libro">Libro</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="descripcion">Area Conocimiento :</label>
                        <select name="area-edt" id="area-edt" class="form-control mb-3" disabled>
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
                                   name="fecha-edt"
                                   id="fecha-edt"
                                   class="form-control"
                                   readonly
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="descripcion">Descripcion :</label>
                        <textarea class="form-control mb-3 "
                                  name="descripcion-edt"
                                  id="descripcion-edt"
                                  rows="4"
                                  cols="59"
                                  readonly
                        ></textarea>
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
                                   readonly
                            >
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection

@section('js')
    <script  src="{{asset('js/DetalleInvestigador.js')}}"></script>
@endsection



