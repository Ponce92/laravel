@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
        <div class="container-fluid area-trabajo">
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
                                               form="editarPersona"
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
                                           class="form-control mb-3"
                                           value="{{$persona->nombre_persona}}"
                                           disabled
                                    >
                                </div>
                                <div class="col">
                                    <label for="apellidos">Apellidos :</label>
                                    <input type="text"
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
                                               name="fehaNacimiento"
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
                                               value="option1"
                                               disabled
                                        >
                                        <label class="form-check-label" for="inlineRadio1">Mujer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               id="Sexo"
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
                                               id="telefonoPersona"
                                               name="telefono"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="nacionalidad">Nacionalidad :</label>
                                    <select id="nacionalidadPersona"
                                            class="form-control"
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
                                       id="institucion"
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
                    <button class="boton-rojo-riues" disabled>
                        Actualizar
                    </button>
                </div>

            </div>

            {{--        Seccion de Usuario del investigador      --}}
            <br>
            <div class="row">
                <div class="col-10">
                    <h2 class="titulo-seccion">Usuario</h2>
                </div>
                <form id="frm-usuario"
                      name="frm-usuario"
                      action="{{route('editarDatosPersonales')}}"
                      method="post"
                >
                    {{ csrf_field()  }}
                </form>
                <div class="col-2 align-middle" style="align-content: center;display: flex;align-items: center">
                    <div class="row align-items-center" >
                        <div class="col">
                            <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                        </div>
                    </div>

                    <div class="col">
                        <i class="fas fa-toggle-off fa-2x inactivo" id="switch-usuario">  </i>
                    </div>

                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="correo">E-Mail : </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email"
                               form="frm-usuario"
                               name="correo"
                               id="correo"
                               class="form-control"
                               value="{{$persona->correo_usuario}}"
                               disabled
                        >
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <label for="viejaClave">Ingrese antiguo password :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="password"
                               disabled
                               form="frm-usuario"
                               name="viejaClave"
                               id="viejaClave"
                               class="form-control"
                        >
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="nuevaClave">Ingrese nuevo password :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="text"
                               name="nuevo"
                               disabled
                               id="nueva"
                               class="form-control"
                        >
                    </div>
                </div>
                <div class="col">
                    <label for="fonfirm">Confirme password :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <input type="password"
                               form="frm-usuario"
                               name="confirm"
                               id="confirm"
                               disabled
                               class="form-control"
                        >
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row pie-seccion">
                <div class="col col-10"></div>
                <div class="col col-1">
                    <button class="boton-rojo-riues" id="btn-usuario" form="frm-usuario" disabled>
                        Actualizar
                    </button>
                </div>

            </div>
        </div>
        <br>
        <br>
        <br>
@endsection

@section('js')
    <script  src="{{asset('js/DatosPersonales.js')}}"></script>
@endsection



