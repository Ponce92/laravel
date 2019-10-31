
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Registro</title>
@stop

@section('cuerpo')
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-sm-11 col-md-8 col-lg-8">
                <form class="login-riues" style="background-color: rgb(252,252,252)" method="POST" action="{{route('registros.store')}}" enctype="multipart/form-data">
                {{ csrf_field()  }}
                    <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <h2 class="titulo">Registrarse en RI-UES</h2>
                            </div>
                        </div>
                    </div>
                    <hr class="all">
                    <div class="row">
                        <div class="col">
                            <h4 style="font-weight: bold">Datos personales</h4>
                        </div>
{{--                        <div class="col">--}}
{{--                            <div class="row justify-content-end">--}}
{{--                                <a href="" style="color: #3e4548;margin-right: 25px;">--}}
{{--                                    Importar de SICCP-UES?--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <hr class="all">
                    @if($errors->any())
                            <div class="alert alert-danger msj">
                                <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;
                                Errores en las entradas del formulario, por favor corrija los campos indicados.
                                &nbsp;
                                <strong>{{ $errors->first() }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                    @endif
{{--                    @include('Common.FlashMsj')--}}

                    <div class="row">
                        <div class="col-4">
                                <div class="row" style="height: 180px;">
                                    <div class=" col text-center">
                                        <img src=""
                                             class="mx-auto d-block img-thumbnail border rounded-0"
                                             alt="No selecionada"
                                             height="180"
                                             id="imgSalida" />
                                    </div>
                                </div>
                            <hr>
                                <div class="row" style="padding-left: 10px">
                                    <label class="" for="foto">Agregar foto:</label>
                                    <input id="foto"
                                           name="foto"
                                           class="form-control-file"
                                           required="true"
                                           type="file"
                                           value="{{old('foto')}}"
                                           accept="image/*"
                                    />
                                    <div class="invalid-feedback">{{$errors->first('foto')}}</div>
                                </div>


                        </div>{{-- Foto del investigador registrado --}}
                        <div class="col-8">
                                <div class="form-row">
                                    <div class="col">
                                        <label class="" for="nombre">Nombres:</label>
                                        <input id="nombre"
                                               name="nombre"
                                               autocomplete="off"
                                               placeholder=""
                                               class="form-control {{$errors->has('nombre') ? 'is-invalid':''}} mb-3"
                                               type="text"
                                               value="{{ old('nombre') }}"
                                        >
                                        <div class="invalid-feedback">
                                            {{$errors->first('nombre')}}
                                        </div>
                                    </div>{{-- Nombre del investigador.......--}}
                                    <div class="col">
                                        <label class="" for="apellido">Apellidos :</label>
                                        <input id="apellido"
                                               name="apellido"
                                               placeholder=""
                                               autocomplete="off"
                                               class="form-control mb-3 {{$errors->has('apellido') ? 'is-invalid':''}}"
                                               type="text"
                                               value="{{ old('apellido') }}"
                                        >
                                        <div class="invalid-feedback">
                                            {{$errors->first('apellido')}}
                                        </div>
                                    </div>{{-- Apellidos del investigador....--}}
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="correo">Correo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope "></i>
                                                </div>
                                            </div>
                                            <input id="correo"
                                                   autocomplete="off"
                                                   name="correo"
                                                   placeholder="empleado@ues.edu.sv"
                                                   class="form-control {{$errors->has('correo') ? 'is-invalid':''}}"
                                                   type="email"
                                                   value="{{old('correo')}}"
                                            >
                                            <div class="invalid-feedback">
                                                {{$errors->first('correo')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="fecha"> Fecha Nacimiento:</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="text"
                                                   style="background-color: white"
                                                   name="fecha"
                                                   placeholder="DD-MM-AAAA"
                                                   id="fecha"
                                                   class="form-control{{$errors->has('fecha') ? 'is-invalid':''}}"
                                                   value="{{old('fecha')}}"
                                            >
                                            <div class="invalid-feedback">
                                                {{$errors->first('fecha')}}
                                            </div>
                                        </div>
                                    </div>{{-- Fecha de nacimiento del investigador --}}
                                    <div class="col">
                                        <label class="" for="sexo">Sexo:</label>
                                        <br>
                                        <label class="radio-inline" for="sexo-0">
                                            <input name="sexo" id="sexo-0" value="false"  checked="checked" type="radio">
                                            Hombre
                                        </label>
                                        <label class="radio-inline" for="sexo-1">
                                            <input name="sexo" id="sexo-1"  value="true" type="radio">
                                            Mujer
                                        </label>
                                </div>{{--- .......Sexo del investigador.........--}}

                        </div>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <!-- Select Basic -->
                            <label class="" for="grado">Grado Académico: </label>
                            <select id="grado" name="grado" class="form-control mb-3">
                                @foreach($gradosc as $grad)
                                    <option value="{{$grad->pk_id_grado}}">
                                        {{$grad->rt_nombre_grado}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="" for="horas">Horas de investigación:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input class="form-control"
                                       id="horas"
                                       name="horas"
                                       type="number"
                                       min="1"
                                       max="16"
                                       step="0.5"
                                       value="{{ old('horas') }}"
                                       required
                                >
                                <div class="invalid-feedback">{{$errors->first('horas')}}</div>
                            </div>

                        </div>
                        <div class="col">
                            <label class="" for="pais">Nacionalidad:</label>
                            <select id="pais"
                                    name="pais"
                                    class="form-control mb-3">
                                @foreach($paisesc as $pais)
                                    <option value="{{$pais->pk_id_pais}}" >
                                        {{$pais->rt_nombre_pais}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   <div class="row">
                       <div class="col">
                           <label class="" for="area">Área de Conocimiento:</label>
                           <select id="area"
                                   name="area"
                                   onchange="verificarSelcArea(this)"
                                   class="form-control"
                           >
                               @foreach($areasc as $area)
                                   <option value="{{$area->pk_id_area}}">
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
                                  value="{{$errors->any() ? old('area-c'):'' }}"
                                  disabled
                           >
                           <div class="invalid-feedback">{{$errors->first('area-c')}}</div>
                       </div>
                   </div>

                    <div class="row">
                        <div class="col-12 ">
                            <label class="" for="institucion">Institución:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-university"></i>
                                    </div>
                                </div>
                                <input id="institucion"
                                       name="institucion"
                                       placeholder="ues..."
                                       class="form-control"
                                       type="text"
                                       value="{{ old('institucion') }}"
                                >
                                <div class="invalid-feedback">{{$errors->first('institucion')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="" for="direccion">Dirección</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <input id="direccion"
                                       name="direccion"
                                       placeholder=""
                                       class="form-control "
                                       type="text"
                                       value="{{ old('direccion') }}">
                            </div>
                            <div class="invalid-feedback">
                              {{$errors->first('direccion')}}
                            </div>
                        </div>
                    </div>
                    <hr class="all">
                    <h2 class="titulo">Usuario</h2>
                    <hr class="all">
                    <div class="row">
                        <div class="col">
                            <label  for="password">Contraseña:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input id="password"
                                       name="password"
                                       class="form-control {{$errors->has('password') ? 'is-invalid':''}} "
                                       type="password"
                                />
                                <div class="invalid-feedback">{{$errors->first('password')}}</div>
                            </div>
                        </div>

                        <div class="col">
                            <label  for="password">Confirme contraseña:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-check-square"></i>
                                    </div>
                                </div>
                                <input id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-control "
                                       type="password"
                                />
                            </div>
                        </div>

                    </div>
                    <hr class="all">
                    <br>
                    <div class="row justify-content-end">
                        <div class="col-2 ">
                            <!-- Button -->
                            <button id="btnregistro" name="btnregistro"  type="submit" class="btn bttn bttn-red ">
                                &nbsp;&nbsp;Registrarse&nbsp;&nbsp;
                            </button>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <br>
                </form>
            </div>

        </div>

    </div>


    <br><br>
@stop

@section('js')
    <script  src="{{asset('js/registro.js')}}"></script>

@stop