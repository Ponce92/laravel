@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">
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
        <li class="breadcrumb-item active">Perfil</li>

    @endif

@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo" >Perfil</h2>
            </div>
        </div>
        <hr>
        @include('Common.FlashMsj')
        <br>
        <div class="row cuerpo-seccion">

            <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 ">{{--+++++++++++++++++++++++++++++++++++ Foto del Usuario++++++++++++++++++++++++++++++++++++ --}}
                            <div class="row">
                                <div class="col-12 div-image">
                                    <img src="{{asset('storage/avatar/'.$perfil->rt_foto_usuario)}}"
                                         alt="vista no disponible"
                                         class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-9">{{-- Nombre y apellido--}}
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nombre">Nombre completo:</label>
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
                                    <label for="apellidos">Apellidos:</label>
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

                            <div class="row">{{-- Fecha y sexo del investigador--}}
                                <div class="col">
                                    <label for="fechaNacimiento">Edad:</label>
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
                                    <label for="Sexo">Sexo:</label><br>
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
                                    <label for="telefono">Email:</label>
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
                                    <label for="nacionalidad">Nacionalidad:</label>
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
                    <div class="row">{{--Área Conocimiento,grado académico,horas dedicadas a investigación --}}
                        <div class="col">
                            <label for="grado">Grado Académico:</label>
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
                            <label for="area"> Área de Conocimiento:</label>
                            <select name="area"
                                    id="area"
                                    form="form"
                                    class="form-control edt"
                                    disabled
                            >
                                @foreach($areas as $area)
                                    <option value="{{$area->pk_id_area}}"
                                            @if($perfil->fk_id_area == $area->pk_id_area) selected @endif>
                                        {{$area->rt_nombre_area}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-4">
                            <label for="horas">Horas dedicadas a la investigación:</label>
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
                            <label for="institucion">Institución:</label>
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
                            <label for="direccion">Dirección:</label>
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

        <!--
                |------------------------------------------------------------------------------------
                |   Opciones del que observa el perfil del investigador . . .
                |-------------------------------------------------------------------------------------
        -->


        <div class="row pie-seccion justify-content-end">

                @if($user->fk_id_rol!=0)
                    <form action="{{route('solicitar.amistad')}}" name="amigo" id="amigo" method="post">
                        {{ csrf_field()  }}
                        <li class="list-group-item bttn-ver f-20" onclick="amigo.submit()">
                                <i class="fas fa-users f-24 "></i>
                                &nbsp;Agregar a contactos
                            <input type="text" name="idU" id="idU" value="{{$perfil->pk_id_usuario}}" hidden>
                        </li>
                    </form>
                    &nbsp;
                        <li class="list-group-item bttn-ver f-20" onclick="proyectos()">
                            <i class="fas fa-code-branch bttn-ver f-24 "></i>
                            &nbsp;Invitar a proyecto
                        </li>
                @else
                    <li class="list-group-item bttn-ver f-20">
                        <i class="fas fa-cog bttn-ver f-24 "></i>
                        &nbsp;Activar investigador
                    </li>
                    &nbsp;
                    <li class="list-group-item bttn-ver f-20">
                        <i class="fas fa-cog bttn-ver f-24"></i>
                        &nbsp;Desactivar investigador
                    </li>
                @endif



            <div class="col-1"></div>
        </div>
       <!--
            |------------------------------------------------------------------------------------
            |   Proyectos y publicaciones del investigador ...
            |-------------------------------------------------------------------------------------
       -->


        <br>
        <h2 class="titulo">Otros</h2>
        <hr>
        <div class="row cuerpo-seccion">
            <ul id="tabs">
                <li><a href="#" name="#tab1">Proyectos Realizados ({{$countA}})</a></li>
                <li><a href="#" name="#tab2">Publicaciones ({{$countB + $countC}})</a></li>
            </ul>
            <div id="content">
                <div id="tab1" class="container-fluid">
                    <div class="row">

                        @if($countA > 0){{--  +++++++++++++++++++++++++++++++  Proyectos realizados  +++++++++++++++++++++++++++++++++++++--}}

                        <table class="table table-bordered">
                            <thead hidden>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="12">Proyectos realizados</td>
                                </tr>
                                @foreach($proyectos as $proyecto )

                                        <tr>
                                            <td rowspan="3" colspan="3" class="align-middle" align="center">
                                                <i class="fab fa-codepen fa-4x "></i>
                                            </td>
                                            <td class="td" colspan="1">Título del Proyecto:</td>
                                            <td colspan="3">{{$proyecto->rt_titulo_proyecto}}</td>
                                            <td class="td" colspan="1">Área de conocimiento:</td>
                                            <td colspan="2">
                                                {{$proyecto['area']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="td">Fech. Inicio:</td>
                                            <td colspan="">{{$proyecto->rf_fecha_inicio_proyecto}}</td>

                                            <td colspan="1" class="td">Fech. finalización:</td>
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
                                    </tbody>
                                    @endforeach

                                </table>

                                
                        @endif
                    </div>
                </div>

                <div id="tab2">
                        @if($countB >0)
                            <table class="table table-bordered">
                                <thead hidden="">
                                    <tr>
                                        <td colspan="12"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="12">Artículos y notas científicas realizadas</td>
                                    </tr>
                                    @foreach($publicaciones as $publicacion)
                                    <tr>
                                        <td colspan="1" rowspan="3" class="align-middle" align="center" style="width: 150px">
                                            <i class="fab fa-codepen fa-4x "></i>
                                        </td>

                                        <td class="td" colspan="1">Título Publicación:</td>
                                        <td colspan="3">
                                            {{$publicacion->rt_titulo}}
                                        </td>
                                        <td class="td" colspan="1">Enlace:</td>
                                        <td colspan="4">
                                            <a href="{{$publicacion->rt_enlace_publicacion }}">
                                                {{$publicacion->rt_enlace_publicacion }}
                                            </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td" colspan="1">Tipo Publicación: </td>
                                        <td colspan="2">
                                            {{$publicacion->rt_tipo_publicacion =='ac' ? 'Artículo Científico':'Nota Científica'}}
                                        </td>
                                        <td class="td" colspan="1"> Área de conocimiento:</td>
                                        <td colspan="2">
                                            {{$publicacion['area']}}
                                        </td>

                                        <td class="td" colspan="1"> Fecha de Publicación: </td>
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


                                </tbody>
                            </table>
                        @endif
                            <hr class="all">
                        @if($countC >0)
                            <table class="table table-bordered">
                                <thead hidden="">
                                <tr>
                                    <td colspan="12"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="12">Artículos y notas científicas realizadas</td>
                                </tr>

                                @foreach($libros as $libro)
                                    <tr>
                                        <td colspan="1" rowspan="3" class="align-middle" align="center" style="width: 150px">
                                            <i class="fab fa-codepen fa-4x "></i>
                                        </td>

                                        <td class="td" colspan="1">Título libro:</td>
                                        <td colspan="4">
                                            {{$libro->rt_titulo}}
                                        </td>
                                        <td class="td" colspan="1">Fecha de publicación:</td>
                                        <td colspan="1">
                                            {{$libro->rf_fecha_publicacion}}
                                        </td>
                                        <td colspan="1" class="td" style="width: 75px">ISSN:</td>
                                        <td colspan="1" >{{$libro->rt_issn}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td" colspan="1">Área de conocimiento:</td>
                                        <td colspan="3">
                                            {{$libro['area']}}
                                        </td>
                                        <td colspan="1" class="td" >Capítulos: </td>
                                        <td colspan="1">{{$libro->rn_capitulo}}</td>

                                        <td colspan="1" class="td" style="width: 125px">Páginas:</td>
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
                                            Descripción:
                                        </td>
                                        <td colspan="8">
                                            {{$libro->rd_descripcion}}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @endif

                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
    <br>
    {{--
        | Fragmento de código para invitar a proyecto de investigación...
    --}}
    <div class="row" hidden>
        <div class="col" style="width: 300px;overflow-x: hidden;" id="proyectos" >
            @if(count($misProyectos) > 0)
                <ul class="list-group all">
                    @foreach($misProyectos as $prj)
                        <li  class="list-group-item list-group-item-action  bttn-ver"  onclick="valueInput('{{$prj->getId()}}')">
                            <i class="{{$prj->getDetalleProyecto()->getIcono()->getNombre()}} fa-2x"></i>&nbsp;
                            <strong>{{$prj->getTitulo()}}</strong>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h4><p>No tiene proyectos... </p></h4>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <hr class="all">
            </div>

            <div class="row justify-content-end">
                    <button class="btn bttn bttn-exit btn-lg"
                            style="color: white"
                            onclick="proyectosExit()"
                            >
                        Cancelar
                    </button>
                    <div class="col-1"></div>
                    <button class="bttn bttn bttn-red btn-lg"
                            onclick="this.form.submit()"
                            form="frg-98u"
                            id="info-12"
                    >
                        Aceptar
                    </button>
                    &nbsp;
            </div>
            <div class="row" hidden>
                <form action="{{route('solicitar.proyecto.union')}}" method="post" name="frg-98u" id="frg-98u">
                    {{ csrf_field()  }}
                    <input type="text" id="inputPrj" name="codigo_proyecto" value="" readonly>
                    <input type="text" id="876" name="codigo_invitado" readonly value="{{$perfil->pk_id_usuario}}">
                </form>
            </div>
        </div>
    </div>

@endsection


@section('js')
        <script  src="{{asset('js/DetalleInvestigador.js')}}"></script>
@endsection
