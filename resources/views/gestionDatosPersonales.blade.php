@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
        <div class="container-fluid area-trabajo" id="area-trabajo">
            {{--    Seccion de datos personales de investigador    --}}
            <br>
            <div class="row cabeza-seccion">
                <div class="col-10">
                    <h2 class="titulo-seccion">Datos Personales</h2>
                </div>
                <div class="col-2 align-middle" style="align-content: center;display: flex;align-items: center">
                    <div class="row align-items-center" >
                        <div class="col">
                            <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                        </div>
                    </div>

                    <div class="col">
                        <i class="fas fa-toggle-off fa-2x inactivo" id="switch-persona"></i>
                    </div>

                </div>
                <form action="{{route('editarDatosPersonales')}}" method="post" name="frm-persona" id="frm-persona" >
                    {{ csrf_field()  }}
                </form>
            </div>
            <hr>
            <br>
            <div class="row cuerpo-seccion">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 ">{{-- Foto del Usuario --}}
                            <div class="row">
                                <div class="col-12 div-image">
                                    <img src="{{asset('avatar/'.$persona->foto_persona)}}"
                                         alt="vista no disponible"
                                         class="img-thumbnail"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input"
                                               id="fotoPersona"
                                               aria-describedby="inputGroupFileAddon01"
                                               form="frm-persona"
                                               disabled
                                        >
                                        <label class="custom-file-label" for="inputGroupFile01">Seleccionar...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">{{-- Nombre y apellido--}}
                            <div class="row">
                                <div class="col">
                                    <label for="nombre">Nombres :</label>
                                    <input type="text"
                                           id="nombrePersona"
                                           name="nombres"
                                           form="frm-persona"
                                           class="form-control mb-3"
                                           value="{{$persona->nombre_persona}}"
                                           disabled
                                    >
                                </div>
                                <div class="col">
                                    <label for="apellidos">Apellidos :</label>
                                    <input type="text"
                                           form="frm-persona"
                                           name="apellidos"
                                           id="apellidosPersona"
                                           class="form-control mb-3"
                                           value="{{$persona->apellido_persona}}"
                                           disabled
                                    >
                                </div>
                            </div>

                            <div class="row">{{-- Fecha y sexo del invetigador--}}
                                <div class="col">
                                    <label for="fechaNacimiento">Fecha Nacimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                               class="form-control "
                                               id="datepicker"
                                               name="fechaN"
                                               form="frm-persona"
                                               value="{{ $persona->fecha_nacimiento }}"
                                               disabled
                                        >

                                    </div>
                                </div>
                                <div class="col">
                                    <label for="Sexo">Sexo :</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="Sexo"
                                               id="Sexo"
                                               form="frm-persona"
                                               value="option1"
                                               disabled
                                        >
                                        <label class="form-check-label" for="inlineRadio1">Mujer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               form="frm-persona"
                                               id="sexo"
                                               value="Sexo"
                                               disabled
                                        >
                                        <label class="form-check-label" for="inlineRadio2">Hombre</label>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <label for="telefono">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                               class="form-control"
                                               form="frm-persona"
                                               id="telefonoPersona"
                                               value="{{$persona->telefono_persona}}"
                                               name="telefono"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="nacionalidad">Nacionalidad :</label>
                                    <select id="nacionalidadPersona"
                                            class="form-control"
                                            form="frm-persona"
                                            disabled
                                    >
                                        @foreach($paises as $pais)
                                            <option value="{{$pais->id_pais}}" @if($pais->id_pais == $persona->id_pais) selected  @endif>
                                                {{$pais->nombre_pais}}
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
                                    form="frm-persona"
                                    class="form-control"
                                    disabled
                            >
                                @foreach($grados as $grado)
                                    <option value="{{$grado->id_grado}}"
                                    @if($persona->id_grado == $grado->id_grado) selected @endif>
                                        {{$grado->nombre_grado}}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col col-4">
                            <label for="area"> Area Conocimiento :</label>
                            <select name="area"
                                    id="area"
                                    form="frm-persona"
                                    class="form-control"
                                    disabled
                            >
                                @foreach($areas as $area)
                                    <option value="{{$area->id_area}}" @if($area->id_area == $persona->id_area) selected @endif>
                                        {{$area->nombre_area}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-4">
                            <label for="horas">Horas dedicadas a investigacion :</label>
                            <input class="form-control"
                                   id="horas"
                                   form="frm-persona"
                                   name="horas_investigacion"
                                   type="number"
                                   value="{{$persona->horas_dedicadas_investigacion}}"
                                   disabled
                            >
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="institucion">Institucion :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-university"></i>
                                    </div>
                                </div>
                                <input type="text"
                                       form="frm-persona"
                                       id="institucion"
                                       name="institucion"
                                       class="form-control"
                                       value="{{$persona->institucion}}"
                                       disabled
                                >
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="direccion">Direccion :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <input type="text"
                                       name="direccion"
                                       form="frm-persona"
                                       id="direccion"
                                       class="form-control"
                                       value="{{$persona->direccion}}"
                                       disabled
                                >
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br><br>
            <div class="row pie-seccion">
                <div class="col col-10"></div>
                <div class="col col-1">
                    <button class="boton-rojo-riues"
                            id="btn-frm-persona"
                            disabled>
                        Actualizar
                    </button>
                </div>

            </div>

            {{--        Seccion de Usuario del investigador      --}}


        </div>
        <br>
        <br>
        <br>
        <div class="row" hidden>
            <div id="mensaje-error-dialog" class="diag-log" title="Entrada de formulario erronea">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-exclamation-triangle fa-2x" style="color: #aa0000"></i>
                    </div>
                    <div class="col-10">
                        Porfavor corrija los campos marcados en color rojo
                    </div>
                </div>
            </div>

            @if(isset($mensaje))
                <div class="dia-log" id="msj" title="Estado">
                    <div class="row">
                        <div class="col-3">
                            <div class="row justify-content-center align-self-center">
                                <div class="col">
                                    <i class="fas fa-check-circle fa-3x" style="color:#00aa00;">
                                    </i>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <b>Exito en la actulizacion</b>
                            <p style="font-size: 16px;">Sus Datos personales se han actualizado correctamente</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
@endsection

@section('js')
    <script  src="{{asset('js/DatosPersonales.js')}}"></script>
@endsection



