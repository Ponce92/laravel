@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item">perfil</li>
    <li class="breadcrumb-item">Datos Personales</li>
@endsection

@section('default')
        <div class="container-fluid area-trabajo" id="area-trabajo">

            <br>
            <div class="row cabeza-seccion">
                <div class="col-10">
                    <h2 class="titulo-seccion titulo">Datos Personales</h2>
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
                    <form action="{{route('editarDatosPersonales')}}" method="post" name="form" id="form" enctype="multipart/form-data">
                        {{ csrf_field()  }}
                        @include('Common.FlashMsj')
                        <div class="row">

                            <div class="col-3 ">{{--+++++++++++++++++++++++++++++++++++ Foto del Usuario++++++++++++++++++++++++++++++++++++ --}}
                                <div class="row justify-content-center">

                                        <img src="{{asset('storage/avatar/'.$user->rt_foto_usuario)}}"
                                             alt="vista no disponible"
                                             style="max-height: 200px;max-width: 250px;"

                                             class="img-thumbnail"
                                        >

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <label for="foto">Foto: </label>
                                            <input type="file"
                                                   class="edt"
                                                   id="foto"
                                                   name="foto"
                                                   form="form"
                                                   accept="image/png,.jpg,.jpej"
                                                   disabled
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">{{-- Nombre y apellido--}}
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nombre">Nombres:</label>
                                        <input type="text"
                                               id="nombres"
                                               name="nombres"
                                               form="form"
                                               class="form-control edt"
                                               value="{{$persona->rt_nombre_persona}}"
                                               disabled
                                        >
                                        <div class="invalid-feedback">
                                            Un nombre válido debe tener más de 6 caracteres y menos de 50.
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="apellidos">Apellidos:</label>
                                        <input type="text"
                                               form="form"
                                               name="apellidos"
                                               id="apellidos"
                                               class="form-control edt"
                                               value="{{$persona->rt_apellido_persona}}"
                                               disabled

                                        >
                                        <div class="invalid-feedback">
                                            Un apellido válido debe tener más de 6 caracteres y menos de 50.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">{{-- Fecha y sexo del investigador--}}
                                    <div class="col">
                                        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
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
                                                   value="{{$persona->rf_fecha_nacimiento }}"
                                                   disabled
                                                   readonly
                                            >
                                            <div class="invalid-feedback">
                                                Debes especificar una fecha.
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="Sexo">Sexo:</label><br>
                                        <div class="form-check form-check-inline edt">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="sexo"
                                                   id="hombre"
                                                   form="form"
                                                   value="true"
                                                   @if($persona->rl_sexo_persona == true) checked @endif
                                            >
                                            <label class="form-check-label" for="inlineRadio1">Hombre</label>
                                        </div>
                                        <div class="form-check form-check-inline edt">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   form="form"
                                                   name="sexo"
                                                   id="mujer"
                                                   value="false"
                                                   @if($persona->rl_sexo_persona == false)checked @endif
                                            >
                                            <label class="form-check-label" for="inlineRadio2">Mujer</label>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col">
                                        <label for="telefono">Correo electrónico</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="text"
                                                   class="form-control edt"
                                                   form="form"
                                                   id="correo"
                                                   value="{{$user->email}}"
                                                   name="correo"
                                                   disabled
                                            >
                                            <div class="invalid-feedback">
                                                El formato del correo es inválido.
                                            </div>
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
                                                        @if($pais->pk_id_pais == $persona->fk_id_pais)
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
                        <div class="row">{{--Área de Conocimiento, grado académico, horas dedicadas a investigación --}}
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
                                        @if($persona->fk_id_grado == $grado->pk_id_grado) selected @endif>
                                            {{$grado->rt_nombre_grado}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col">
                                <label class="" for="area">Área de Conocimiento:</label>
                                <select id="area"
                                        name="area"
                                        onchange="verificarSelcArea(this)"
                                        class="form-control edt"
                                        disabled

                                >
                                    @foreach($areas as $area)
                                        <option value="{{$area->pk_id_area}}"
                                        @if($persona->fk_id_area < 100)
                                            {{$area->pk_id_area ==$persona->fk_id_area ? 'selected':''}}
                                            @else
                                            {{$area->pk_id_area == 7 ? 'selected':''}}
                                        @endif
                                        >
                                            {{$area->rt_nombre_area}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="area-c">Especifique Área:</label>
                                <input type="text"
                                       name="area-c"
                                       id="area-c"
                                       class="form-control {{$errors->has('area-c') ? 'is-invalid':''}}"
                                       value="{{$persona->fk_id_area >100 ? $persona['area']:''}}"
                                >
                                <div class="invalid-feedback">{{$errors->first('area-c')}}</div>
                            </div>


                            <div class="col col-4">
                                <label for="horas">Horas dedicadas a investigación :</label>
                                <input class="form-control edt"
                                       id="horas"
                                       form="form"
                                       name="horas"
                                       type="number"
                                       value="{{$persona->rn_horas_dedicadas_investigacion}}"
                                       disabled
                                >
                                <div class="invalid-feedback">
                                    Debe especificar las horas de investigación, no puede ser menor que 1 ni mayor que 14 horas.
                                </div>
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
                                           autocomplete="false"
                                           class="form-control edt"
                                           value="{{$persona->rt_institucion}}"
                                           disabled
                                    >
                                    <div class="invalid-feedback">
                                        Un nombre válido contiene entre 6 a 100 caracteres
                                    </div>
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
                                            autocomplete="false"
                                            class="form-control edt"
                                            value="{{$persona->rt_direccion}}"
                                            disabled
                                    >
                                    <div class="invalid-feedback">
                                        Debe proporcionar su dirección actual.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row pie-seccion">
                <div class="col col-10"></div>
                <div class="col col-1">
                    <button class="btn bttn-red edt"
                            id="actualizar"
                            form="form"
                            >
                        Actualizar
                    </button>
                </div>
            </div>
        </div>
        <br>
        <br>
@endsection

@section('js')
    <script  src="{{asset('js/DatosPersonales.js')}}"></script>
@endsection



