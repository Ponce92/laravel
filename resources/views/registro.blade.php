
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Registro</title>
@stop

@section('cuerpo')
    <br>

    <div class="container-fluid form-control " id="area" >
        <div class=" mx-auto" style="width: 1100px;">

            <form class="form-group" method="POST" action="/registros" enctype="multipart/form-data">

            {{ csrf_field()  }}
            <!-- Form Name -->

            <legend>Datos Personales</legend>
            <br>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                             <ul>
                                 @foreach($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                     @endforeach
                             </ul>
                    </div>
                    @endif


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="" for="foto">Cargar foto</label>
                            <!-- File Button -->
                            <br>
                            <input id="foto" name="foto" class="input-file " required="" type="file" value="{{ old('foto') }}">
                        </div>

                    </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <!-- Text input-->
                    <label class="" for="nombre">Nombres</label>
                    <input id="nombre" name="nombre" placeholder=""   class="form-control input-md" size="30" required="" type="text" value="{{ old('nombre') }}">
                </div>
                <div class="form-group col-md-4">
                    <!-- Text input-->
                    <label class="" for="apellido">Apellidos</label>
                    <input id="apellido" name="apellido"  placeholder="" class="form-control input-md" required="" type="text" value="{{ old('apellido') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
            <!-- Text input-->
                <label class="" for="fecha">Fecha</label>
                    <input id="fecha" name="fecha" placeholder="AAAA-MM-DD"  class="form-control input-md" type="text" value="{{ old('fecha') }}">
                </div>
                <div class="form-group col-md-4">
                    <!-- Multiple Radios (inline) -->
                    <label class="" for="sexo">Sexo</label>
                    <br>
                    <label class="radio-inline" for="sexo-0">
                        <input name="sexo" id="sexo-0" value="true"  checked="checked" type="radio">
                        H
                    </label>
                    <label class="radio-inline" for="sexo-1">
                        <input name="sexo" id="sexo-1"  value="false" type="radio">
                        M
                    </label>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
            <!-- Appended Input-->
                <label class="" for="telefono">Teléfono</label>
                    <div class="input-group">
                        <input id="telefono" name="telefono" placeholder="Móvil o Fijo" required="" type="text" value="{{ old('telefono') }}">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <!-- Select Basic -->
                    <label class="" for="grado">Grado Academico </label>
                    <select id="grado" name="grado" class="form-control">
                        @foreach($gradosc as $grad)
                            <option value="{{$grad->pk_id_grado}}">
                                {{$grad->rt_nombre_grado}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <!-- Select Basic -->
                    <label class="" for="horas">Horas de investigacion</label>
                    <input class="form-control"
                           id="horas"
                           name="horas_investigacion"
                           type="number"
                           value="{{ old('horas') }}"
                           required

                    >
                </div>
            </div>



            <div class="row">
                <div class="form-group col-md-4">
                    <!-- Select Basic -->
                    <label class="" for="areas">Area de Conocimiento</label>
                    <select id="areas" name="areas" class="form-control">
                        @foreach($areasc as $area)
                            <option value="{{$area->pk_id_area}}">
                                {{$area->rt_nombre_area}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <!-- Select Basic -->
                    <label class="" for="nacionalidad">Nacionalidad</label>
                    <select id="nacionalidad" name="nacionalidad" class="form-control">
                        @foreach($paisesc as $pais)
                            <option value="{{$pais->pk_id_pais}}" >
                                {{$pais->rt_nombre_pais}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
            <!-- Text input-->
                <label class="" for="institucion">Institucion</label>
                    <input id="institucion" name="institucion"  placeholder="A la que pertenece" class="form-control" required="" type="text" value="{{ old('institucion') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
            <!-- Text input-->
                <label class="" for="direccion">Direccion</label>
                    <input id="direccion" name="direccion"  placeholder="" class="form-control " type="text" value="{{ old('direccion') }}">
                </div>
            </div>

            <br>
            <!-- Form Name -->
            <legend>Usuario</legend>
            <br>

            <!-- Text input-->
            <div class="row">
                <div class="form-group col-md-4">

                    <label for="correo">Correo</label>
                    <input id="correo" name="correo"  placeholder="@Correo electronico" class="form-control input-md" required="" type="email">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
            <!-- Password input-->
                <label  for="contrasenia1">Contraseña</label>
                    <input id="password" name="password"  placeholder="Ingrese la contraseña" class="form-control input-md " required="" type="password">
                    <span class="help-block">6 Caracteres como minimo</span>
                </div>

                <div class="form-group col-md-4">
                    <!-- Password input-->
                    <label for="contrasenia2">Contraseña</label>
                    <input id="password-confirm" type="password" placeholder="Confirme la contraseña " class="form-control" name="password_confirmation" required>
                </div>
                </div>



            <div class="row">
            <div class="form-group col-md-4">
                <!-- Button -->
                <label for="btnregistro"></label>
                <button id="btnregistro" name="btnregistro"  type="submit" class="btn btn-danger">Registrarse</button>
            </div>
            </div>
            </form>
        </div>
    </div>



@stop

@section('js')

@stop